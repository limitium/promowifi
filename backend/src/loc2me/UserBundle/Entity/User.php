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
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;



    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return User
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
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
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
}
