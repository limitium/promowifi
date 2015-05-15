<?php

namespace loc2me\OfferBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offer
 */
class Offer
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
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var integer
     */
    private $views;

    private $rawImage;
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
     * @return Offer
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
     * Set description
     *
     * @param string $description
     * @return Offer
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Offer
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
     * @return Offer
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
     * @return mixed
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * @param mixed $views
     */
    public function setViews($views)
    {
        $this->views = $views;
    }

    /**
     * @return mixed
     */
    public function getRawImage()
    {
        return $this->rawImage;
    }

    /**
     * @param mixed $rawImage
     */
    public function setRawImage($rawImage)
    {
        $this->rawImage = $rawImage;
    }


    /**
     * @var \loc2me\OfferBundle\Entity\Image
     */
    private $Image;


    /**
     * Set Image
     *
     * @param \loc2me\OfferBundle\Entity\Image $image
     * @return Offer
     */
    public function setImage(\loc2me\OfferBundle\Entity\Image $image = null)
    {
        $this->Image = $image;

        return $this;
    }

    /**
     * Get Image
     *
     * @return \loc2me\OfferBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->Image;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $Lookups;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Lookups = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add Lookups
     *
     * @param \loc2me\OfferBundle\Entity\OfferLookUp $lookups
     * @return Offer
     */
    public function addLookup(\loc2me\OfferBundle\Entity\OfferLookUp $lookups)
    {
        $this->Lookups[] = $lookups;

        return $this;
    }

    /**
     * Remove Lookups
     *
     * @param \loc2me\OfferBundle\Entity\OfferLookUp $lookups
     */
    public function removeLookup(\loc2me\OfferBundle\Entity\OfferLookUp $lookups)
    {
        $this->Lookups->removeElement($lookups);
    }

    /**
     * Get Lookups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLookups()
    {
        return $this->Lookups;
    }
}
