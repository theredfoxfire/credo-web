<?php

namespace AppBundle\Entity;

/**
 * Whoweare
 */
class Whoweare
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
    private $whoweare;

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
     * @return Whoweare
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
     * Set whoweare
     *
     * @param string $whoweare
     *
     * @return Whoweare
     */
    public function setWhoweare($whoweare)
    {
        $this->whoweare = $whoweare;

        return $this;
    }

    /**
     * Get whoweare
     *
     * @return string
     */
    public function getWhoweare()
    {
        return $this->whoweare;
    }

    /**
     * Set largeImage
     *
     * @param string $largeImage
     *
     * @return Whoweare
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
