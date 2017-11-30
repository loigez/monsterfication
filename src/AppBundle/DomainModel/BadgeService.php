<?php
namespace AppBundle\DomainModel;

use AppBundle\Entity\Badge;
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
    }

    /**
     *
     */
    public function findAll()
    {
        return $this->entityManager->getRepository(Badge::class)->findAll();
    }

    /**
     * @param Badge $badge
     */
    public function save(Badge $badge)
    {
        $this->entityManager->persist($badge);
        $this->entityManager->flush();
    }

}