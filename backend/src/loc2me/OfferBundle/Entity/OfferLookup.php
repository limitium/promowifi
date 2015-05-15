<?php

namespace loc2me\OfferBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OfferLookUp
 */
class OfferLookup
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $wifiName;

    /**
     * @var \DateTime
     */
    private $created_at;

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
     * Set wifiName
     *
     * @param string $wifiName
     * @return OfferLookup
     */
    public function setWifiName($wifiName)
    {
        $this->wifiName = $wifiName;

        return $this;
    }

    /**
     * Get wifiName
     *
     * @return string 
     */
    public function getWifiName()
    {
        return $this->wifiName;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return OfferLookup
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $Offers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Offers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add Offers
     *
     * @param \loc2me\OfferBundle\Entity\Offer $offers
     * @return OfferLookup
     */
    public function addOffer(\loc2me\OfferBundle\Entity\Offer $offers)
    {
        $this->Offers[] = $offers;

        return $this;
    }

    /**
     * Remove Offers
     *
     * @param \loc2me\OfferBundle\Entity\Offer $offers
     */
    public function removeOffer(\loc2me\OfferBundle\Entity\Offer $offers)
    {
        $this->Offers->removeElement($offers);
    }

    /**
     * Get Offers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOffers()
    {
        return $this->Offers;
    }
}
