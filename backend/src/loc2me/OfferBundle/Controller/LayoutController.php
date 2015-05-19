<?php

namespace loc2me\OfferBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;

use FOS\RestBundle\Controller\Annotations\QueryParam;

use FOS\RestBundle\View\View;
use loc2me\OfferBundle\Entity\File;
use loc2me\OfferBundle\Entity\Image;
use loc2me\OfferBundle\Entity\Offer;
use loc2me\OfferBundle\Entity\OfferLookup;
use loc2me\OfferBundle\Form\OfferType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Form;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class LayoutController extends Controller
{
    /**
     *
     * @Template()
     */
    public function indexAction()
    {
    }

}