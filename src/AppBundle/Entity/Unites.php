<?php

namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Unites
 */
class Unites
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
    private $story;

    /**
     * @var string
     * @Assert\Image(
     * )
     *
     */
    private $largeImage;

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
     * @return Unites
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
     * Set story
     *
     * @param string $story
     *
     * @return Unites
     */
    public function setStory($story)
    {
        $this->story = $story;

        return $this;
    }

    /**
     * Get story
     *
     * @return string
     */
    public function getStory()
    {
        return $this->story;
    }

    /**
     * Set largeImage
     *
     * @param string $largeImage
     *
     * @return Unites
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
     * Set smallImage
     *
     * @param string $smallImage
     *
     * @return Unites
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
