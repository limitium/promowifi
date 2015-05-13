<?php

namespace loc2me\OfferBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OfferLookUp
 */
class OfferLookUp
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
     * @return OfferLookUp
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
}
