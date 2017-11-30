<?php
namespace AppBundle\DomainModel;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserService
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

    public function getAll()
    {
        return $this->entityManager->getRepository(User::class)->findAll();
    }

}