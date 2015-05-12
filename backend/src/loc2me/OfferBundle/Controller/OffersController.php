<?php

namespace loc2me\OfferBundle\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OffersController extends Controller
{
    /**
     * @Rest\View
     */
    public function getOffersAction()
    {
        return [1 => 2];
    }
}