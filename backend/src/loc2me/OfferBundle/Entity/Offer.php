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
    private $name;

    /**
     * @var string
     */
    private $organizationName;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \loc2me\OfferBundle\Entity\Avatar
     */
    private $Avatar;


    /**
     * @var \loc2me\OfferBundle\Entity\Image
     */
    private $Image;
    private $rawAvatar;
    private $rawImage;

    /**
     * @var \loc2me\UserBundle\Entity\User
     */
    private $User;

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
     * Set name
     *
     * @param string $name
     * @return Offer
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set organizationName
     *
     * @param string $organizationName
     * @return Offer
     */
    public function setOrganizationName($organizationName)
    {
        $this->organizationName = $organizationName;

        return $this;
    }

    /**
     * Get organizationName
     *
     * @return string
     */
    public function getOrganizationName()
    {
        return $this->organizationName;
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Offer
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
     * @return Offer
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

    /**
     * Set Avatar
     *
     * @param \loc2me\OfferBundle\Entity\Avatar $avatar
     * @return Offer
     */
    public function setAvatar(\loc2me\OfferBundle\Entity\Avatar $avatar = null)
    {
        $this->Avatar = $avatar;

        return $this;
    }

    /**
     * Get Avatar
     *
     * @return \loc2me\OfferBundle\Entity\Avatar
     */
    public function getAvatar()
    {
        return $this->Avatar;
    }

    /**
     * Set User
     *
     * @param \loc2me\UserBundle\Entity\User $user
     * @return Offer
     */
    public function setUser(\loc2me\UserBundle\Entity\User $user = null)
    {
        $this->User = $user;

        return $this;
    }

    /**
     * Get User
     *
     * @return \loc2me\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->User;
    }

    /**
     * Add Lookups
     *
     * @param \loc2me\OfferBundle\Entity\OfferLookup $lookups
     * @return Offer
     */
    public function addLookup(\loc2me\OfferBundle\Entity\OfferLookup $lookups)
    {
        $this->Lookups[] = $lookups;

        return $this;
    }

    /**
     * Remove Lookups
     *
     * @param \loc2me\OfferBundle\Entity\OfferLookup $lookups
     */
    public function removeLookup(\loc2me\OfferBundle\Entity\OfferLookup $lookups)
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
     * @return mixed
     */
    public function getRawAvatar()
    {
        return $this->rawAvatar;
    }

    /**
     * @param mixed $rawAvatar
     */
    public function setRawAvatar($rawAvatar)
    {
        $this->rawAvatar = $rawAvatar;
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


    public function getImageUrl()
    {
        return $this->getImage()->__toString();
    }

    public function getAvatarUrl()
    {
        $avatar = $this->getAvatar();
        if (!$avatar) {
            return '';
        }
        return $avatar->__toString();
    }

    public function getViewsCount()
    {
        return $this->getLookups()->count();
}
    /**
     * @var boolean
     */
    private $isDisposable;


    /**
     * Set isDisposable
     *
     * @param boolean $isDisposable
     * @return Offer
     */
    public function setIsDisposable($isDisposable)
    {
        $this->isDisposable = $isDisposable;

        return $this;
    }

    /**
     * Get isDisposable
     *
     * @return boolean 
     */
    public function getIsDisposable()
    {
        return $this->isDisposable;
    }
}
