<?php
namespace AppBundle\DomainModel;

use Doctrine\ORM\EntityManagerInterface;

class BadgeService
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * BadgeService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        //repository
    }

}