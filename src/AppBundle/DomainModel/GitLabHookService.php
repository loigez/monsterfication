<?php
namespace AppBundle\DomainModel;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class GitLabHookService
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var UserService
     */
    private $userService;
    /**
     * @var BadgeService
     */
    private $badgeService;

    /**
     * BadgeService constructor.
     */
    public function __construct(UserService $userService, BadgeService $badgeService)
    {
        $this->userService = $userService;
        $this->badgeService = $badgeService;
    }

    public function findAll()
    {
        return $this->entityManager->getRepository(User::class)->findAll();
    }

    public function getById(int $id)
    {
        return $this->entityManager->getRepository(User::class)->find($id);
    }

}