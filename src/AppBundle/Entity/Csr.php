<?php

namespace AppBundle\Entity;

/**
 * Csr
 */
class Csr
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $organitation;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $facisimile;

    /**
     * @var string
     */
    private $largeImage;

    /**
     * @var string
     */
    private $mediumImage;

    /**
     * @var string
     */
    private $smallImage;


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
     * Set title
     *
     * @param string $title
     *
     * @return Csr
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Csr
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
     * Set organitation
     *
     * @param string $organitation
     *
     * @return Csr
     */
    public function setOrganitation($organitation)
    {
        $this->organitation = $organitation;

        return $this;
    }

    /**
     * Get organitation
     *
     * @return string
     */
    public function getOrganitation()
    {
        return $this->organitation;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Csr
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Csr
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set facisimile
     *
     * @param string $facisimile
     *
     * @return Csr
     */
    public function setFacisimile($facisimile)
    {
        $this->facisimile = $facisimile;

        return $this;
    }

    /**
     * Get facisimile
     *
     * @return string
     */
    public function getFacisimile()
    {
        return $this->facisimile;
    }

    /**
     * Set largeImage
     *
     * @param string $largeImage
     *
     * @return Csr
     */
    public function setLargeImage($largeImage)
    {
        $this->largeImage = $largeImage;

        return $this;
    }

    /**
     * Get largeImage
     *
     * @return string
     */
    public function getLargeImage()
    {
        return $this->largeImage;
    }

    /**
     * Set mediumImage
     *
     * @param string $mediumImage
     *
     * @return Csr
     */
    public function setMediumImage($mediumImage)
    {
        $this->mediumImage = $mediumImage;

        return $this;
    }

    /**
     * Get mediumImage
     *
     * @return string
     */
    public function getMediumImage()
    {
        return $this->mediumImage;
    }

    /**
     * Set smallImage
     *
     * @param string $smallImage
     *
     * @return Csr
     */
    public function setSmallImage($smallImage)
    {
        $this->smallImage = $smallImage;

        return $this;
    }

    /**
     * Get smallImage
     *
     * @return string
     */
    public function getSmallImage()
    {
        return $this->smallImage;
    }
}

