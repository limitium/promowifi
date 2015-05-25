<?php

namespace loc2me\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 */
class User extends BaseUser
{

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
        parent::__construct();
    }


    /**
     * Add Offers
     *
     * @param \loc2me\OfferBundle\Entity\Offer $offers
     * @return User
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
    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;



    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return User
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
