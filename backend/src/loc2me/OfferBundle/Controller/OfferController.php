<?php

namespace loc2me\OfferBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;


use FOS\RestBundle\View\View;
use loc2me\OfferBundle\Entity\Avatar;
use loc2me\OfferBundle\Entity\File;
use loc2me\OfferBundle\Entity\Image;
use loc2me\OfferBundle\Entity\Offer;
use loc2me\OfferBundle\Entity\OfferLookup;
use loc2me\OfferBundle\Form\OfferType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Form;

class OfferController extends Controller
{
    /**
     * @Rest\View(serializerGroups={"Default"})
     * @Rest\QueryParam(name="name", nullable=false, requirements="\w+")
     * @Rest\QueryParam(name="mac", nullable=false, requirements="([a-fA-F0-9]{2}[:|\-]?){6}")
     *
     * @param ParamFetcher $params
     * @return
     */
    public function getOffersSearchAction(ParamFetcher $params)
    {

        $em = $this->getDoctrine()->getManager();

        $wifiName = $params->get('name', '');
        $mac = $params->get('mac', '');

        $offerLookup = new OfferLookup();
        $offerLookup->setWifiName($wifiName);
        $offerLookup->setMac($mac);

        $offers = $em
            ->getRepository('loc2meOfferBundle:Offer')
            ->findByWifiName($wifiName);

        /** @var Offer $offer */
        foreach ($offers as $offer) {
            $offer->addLookup($offerLookup);
            $offerLookup->addOffer($offer);
        }

        $em->persist($offerLookup);
        $em->flush();
        return $offers;
    }

    /**
     * @Rest\View(serializerGroups={"Default","List"})
     */
    public function getOffersAction()
    {
        $em = $this->getDoctrine()->getManager();

        return $em
            ->getRepository('loc2meOfferBundle:Offer')
            ->findBy(['User' => $this->getUser()]);
    }

    /**
     * @Rest\View(serializerGroups={"Default","Edit"})
     * @param Offer $offer
     * @return Offer
     */
    public function getOfferAction(Offer $offer)
    {
        return $offer;
    }

    /**
     * @Rest\View
     * @param Request $request
     * @return View|Response
     */
    public function postOffersAction(Request $request)
    {
        $offer = new Offer();
        $offer->setUser($this->getUser());
        $form = $this->createForm(new OfferType(), $offer);
        return $this->processForm($form, $request, $offer);
    }

    /**
     * @Rest\View
     * @param Offer $offer
     * @param Request $request
     * @return View|Response
     */
    public function putOffersAction(Offer $offer, Request $request)
    {
        $form = $this->createForm(new OfferType(), $offer, ['method' => 'PUT']);
        return $this->processForm($form, $request, $offer);
    }

    /**
     * @Rest\View(statusCode=204)
     * @param Offer $offer
     * @return Offer
     */
    public function deleteOfferAction(Offer $offer)
    {
        $this->deleteImage($offer->getImage());
        $em = $this->getDoctrine()->getManager();
        $em->remove($offer);
        $em->flush();
        return $offer;
    }

    private function processForm(Form $form, Request $request, Offer $offer)
    {

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->uploadImage($offer);
            $this->uploadAvatar($offer);

            $statusCode = $offer->getId() ? 204 : 201;
            $em = $this->getDoctrine()->getManager();
            $em->persist($offer);
            $em->flush();

            $response = new Response();
            $response->setStatusCode($statusCode);

            if ($statusCode == 201) {
                $response->headers->set('Location',
                    $this->generateUrl(
                        'get_offer', array('offer' => $offer->getId()),
                        true // absolute
                    )
                );
            }

            return $response;
        }

        return View::create($form, 400);
    }

    private function uploadImage(Offer $offer)
    {
        if ($offer->getRawImage()) {
            $hash = $this->upload($offer->getRawImage());

            $image = $offer->getImage();
            if (!$image) {
                $image = new Image();
            } else {
                $this->deleteImage($image);
            }
            $image->setHash($hash);
            $image->setOffer($offer);
            $offer->setImage($image);
        }
    }

    private function uploadAvatar(Offer $offer)
    {
        if ($offer->getRawAvatar()) {
            $hash = $this->upload($offer->getRawAvatar());

            $avatar = $offer->getAvatar();
            if (!$avatar) {
                $avatar = new Avatar();
            } else {
                $this->deleteImage($avatar);
            }
            $avatar->setHash($hash);
            $avatar->setOffer($offer);
            $offer->setAvatar($avatar);
        }
    }

    private function upload($imgDataUrl)
    {
        list($type, $data) = explode(';', $imgDataUrl);
        list(, $data) = explode(',', $data);
        $decodedData = base64_decode($data);
        $hash = md5($decodedData);
        $hash = md5($hash . microtime(1));

        $fileName = $this->getImageName($hash);
        file_put_contents($fileName, $decodedData);
        return $hash;
    }

    /**
     * @param $hash
     * @return string
     */
    private function getImageName($hash)
    {
        $uploadPath = $this->get('kernel')->getRootDir() . '/../web/cdn/';

        $fileName = $uploadPath . $hash . '.png';
        return $fileName;
    }

    private function deleteImage($image)
    {
        if ($image) {
            unlink($this->getImageName($image->getHash()));
        }
    }
}