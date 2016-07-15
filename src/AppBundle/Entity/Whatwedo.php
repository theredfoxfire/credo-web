<?php

namespace AppBundle\Entity;

/**
 * Whatwedo
 */
class Whatwedo
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
    private $whatwedo;

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
     * @return Whatwedo
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
     * Set whatwedo
     *
     * @param string $whatwedo
     *
     * @return Whatwedo
     */
    public function setWhatwedo($whatwedo)
    {
        $this->whatwedo = $whatwedo;

        return $this;
    }

    /**
     * Get whatwedo
     *
     * @return string
     */
    public function getWhatwedo()
    {
        return $this->whatwedo;
    }

    /**
     * Set largeImage
     *
     * @param string $largeImage
     *
     * @return Whatwedo
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
