<?php

namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Logo
 */
class Logo
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     * @Assert\Image(
     * )
     */
    private $largeImage;

    /**
     * @var \DateTime
     */
    private $createdAt;

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
     * Set largeImage
     *
     * @param string $largeImage
     *
     * @return Logo
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Logo
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
}