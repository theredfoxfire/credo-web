<?php
namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;

class GetCategories {
    /**
    * @var EntityManager Object
    */
    private $em;

    /**
    * Inject EntityManager into the class
    */
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    /**
    * return Object of Business Category
    */
    public function getCategories() {
        return $this->em->getRepository('AppBundle:Category')->findAll();
    }
}
