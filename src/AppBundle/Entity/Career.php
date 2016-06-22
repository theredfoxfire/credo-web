<?php

namespace AppBundle\Entity;

/**
 * Career
 */
class Career
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
    private $decsription;

    /**
     * @var string
     */
    private $largeImage;


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
     * @return Career
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
     * Set decsription
     *
     * @param string $decsription
     *
     * @return Career
     */
    public function setDecsription($decsription)
    {
        $this->decsription = $decsription;

        return $this;
    }

    /**
     * Get decsription
     *
     * @return string
     */
    public function getDecsription()
    {
        return $this->decsription;
    }

    /**
     * Set largeImage
     *
     * @param string $largeImage
     *
     * @return Career
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
}

