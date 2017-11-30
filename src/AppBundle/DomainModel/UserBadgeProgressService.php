<?php

namespace AppBundle\DomainModel;

use AppBundle\Entity\Badge;
use AppBundle\Entity\State;
use AppBundle\Entity\User;
use AppBundle\Entity\UserBadgeProgress;
use Doctrine\ORM\EntityManagerInterface;


class UserBadgeProgressService
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
     * @param User $user
     * @param Badge[] $badges
     */
    public function assignBadgesToUser(User $user, array $badges)
    {
        foreach ($badges as $badge) {
            $badgesToUser = new UserBadgeProgress();
            $badgesToUser->setUser($user);
            $badgesToUser->setState(State::LOCKED);
            $badgesToUser->setProgress(0);
            $badgesToUser->setBadge($badge);
            $this->entityManager->persist($badgesToUser);
        }

        $this->entityManager->flush();
    }

    /**
     * @param User $user
     * @param Badge $badge
     */
    public function activateUsersBadge(User $user, Badge $badge)
    {
        $badgesToUser = $this->entityManager
            ->getRepository(UserBadgeProgress::class)
            ->findBadgeProgressForUser($badge, $user);

        $badgesToUser->setState(State::UNLOCKED);
        $badgesToUser->setProgress($badge->getTarget());
        $this->entityManager->persist($badgesToUser);
        $this->entityManager->flush();
    }

    /**
     * @param User $user
     * @param Badge $badge
     */
    public function unactivateUsersBadge(User $user, Badge $badge)
    {
        $badgesToUser = $this->entityManager
            ->getRepository(UserBadgeProgress::class)
            ->findBadgeProgressForUser($badge, $user);

        $badgesToUser->setState(State::LOCKED);
        $badgesToUser->setProgress($badge->getTarget());
        $this->entityManager->persist($badgesToUser);
        $this->entityManager->flush();
    }


    public function persist(UserBadgeProgress $progressBadge)
    {
        $this->entityManager->persist($progressBadge);
        $this->entityManager->flush();
    }


}