<?php

namespace loc2me\OfferBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;

use FOS\RestBundle\Controller\Annotations\QueryParam;

use FOS\RestBundle\View\View;
use loc2me\OfferBundle\Entity\Offer;
use loc2me\OfferBundle\Entity\OfferLookUp;
use loc2me\OfferBundle\Form\OfferType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OfferController extends Controller
{
    /**
     * @Rest\View
     * @Rest\QueryParam(name="name", nullable=false, requirements="\w+")
     *
     * @param ParamFetcher $params
     * @return
     */
    public function getOffersSearchAction(ParamFetcher $params)
    {

        $em = $this->getDoctrine()->getManager();

        $wifiName = $params->get('name', '');

        $offerLookUp = new OfferLookUp();
        $offerLookUp->setWifiName($wifiName);

        $em->persist($offerLookUp);
        $em->flush();

        return $em
            ->getRepository('loc2meOfferBundle:Offer')
            ->findByWifiName($wifiName);
    }

    /**
     * @Rest\View
     */
    public function getOffersAction()
    {
        $em = $this->getDoctrine()->getManager();

        return $em
            ->getRepository('loc2meOfferBundle:Offer')
            ->findAll();
    }

    /**
     * @Rest\View
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
        return $this->processForm($request, new Offer());
    }

    private function processForm(Request $request, Offer $offer)
    {

        $form = $this->createForm(new OfferType(), $offer);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($offer);
            $em->flush();
            $response = new Response();
            $response->setStatusCode(201);

            $response->headers->set('Location',
                $this->generateUrl(
                    'get_offer', array('offer' => $offer->getId()),
                    true // absolute
                )
            );

            return $response;
        }

        return View::create($form, 400);
    }
}