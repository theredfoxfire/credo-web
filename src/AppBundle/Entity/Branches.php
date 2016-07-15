<?php

namespace AppBundle\Entity;

/**
 * Branches
 */
class Branches
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $brancheName;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set brancheName
     *
     * @param string $brancheName
     *
     * @return Branches
     */
    public function setBrancheName($brancheName)
    {
        $this->brancheName = $brancheName;

        return $this;
    }

    /**
     * Get brancheName
     *
     * @return string
     */
    public function getBrancheName()
    {
        return $this->brancheName;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Branches
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
     * @return Branches
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
     * @return Branches
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
}
