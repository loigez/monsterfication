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
     * @param int $id
     * @return Badge
     */
    public function find($id)
    {
        return $this->entityManager->getRepository(Badge::class)->find($id);
    }

    /**
     * @param Badge $badge
     */
    public function save(Badge $badge)
    {
        $this->entityManager->persist($badge);
        $this->entityManager->flush();
    }

    /**
     * @param Badge $badge
     */
    public function delete(Badge $badge)
    {
        $this->entityManager->remove($badge);
        $this->entityManager->flush();
    }

}