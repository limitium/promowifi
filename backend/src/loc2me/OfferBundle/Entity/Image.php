<?php

namespace loc2me\OfferBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 */
class Image
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $hash;

    /**
     * @var \loc2me\OfferBundle\Entity\Offer
     */
    private $Offer;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set hash
     *
     * @param string $hash
     * @return Image
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get hash
     *
     * @return string 
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set Offer
     *
     * @param \loc2me\OfferBundle\Entity\Offer $offer
     * @return Image
     */
    public function setOffer(\loc2me\OfferBundle\Entity\Offer $offer = null)
    {
        $this->Offer = $offer;

        return $this;
    }

    /**
     * Get Offer
     *
     * @return \loc2me\OfferBundle\Entity\Offer 
     */
    public function getOffer()
    {
        return $this->Offer;
    }

    function __toString()
    {
        return '/cdn/' . $this->getHash() . '.png';
    }
}
