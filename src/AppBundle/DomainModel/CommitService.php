<?php
namespace AppBundle\DomainModel;

use AppBundle\Entity\Commit;
use Doctrine\ORM\EntityManagerInterface;

class CommitService
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
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
        return $this->entityManager->getRepository(Commit::class)->findAll();
    }

    /**
     * @param int $id
     * @return null|object
     */
    public function find($id)
    {
        return $this->entityManager->getRepository(Commit::class)->find($id);
    }

    /**
     * @param Commit $commit
     */
    public function save(Commit $commit)
    {
        $this->entityManager->persist($commit);
        $this->entityManager->flush();
    }

    public function isCommitHash(string $commitHash): bool
    {
        return null !== $this->entityManager->getRepository(Commit::class)->findOneBy(
            ['commitHash' => $commitHash]
        );

    }

}