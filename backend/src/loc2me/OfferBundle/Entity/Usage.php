<?php

namespace loc2me\OfferBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usage
 */
class Usage
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $createdAt;

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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Usage
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set Offer
     *
     * @param \loc2me\OfferBundle\Entity\Offer $offer
     * @return Usage
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
    /**
     * @var string
     */
    private $mac;


    /**
     * Set mac
     *
     * @param string $mac
     * @return Usage
     */
    public function setMac($mac)
    {
        $this->mac = $mac;

        return $this;
    }

    /**
     * Get mac
     *
     * @return string 
     */
    public function getMac()
    {
        return $this->mac;
    }
}
