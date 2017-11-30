<?php
namespace AppBundle\DomainModel;

use AppBundle\Entity\User;
use Doctrine\Common\Collections\Criteria;
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

    public function findAll()
    {
        return $this->entityManager->getRepository(User::class)->findAll();
    }

    /**
     * @param int $id
     * @return null|object
     */
    public function find($id)
    {
        return $this->entityManager->getRepository(User::class)->find($id);
    }

    public function getByEmail($email)
    {
        return $this->entityManager->getRepository(User::class)->findOneBy(
            ['email' => $email]
        );

    }

}