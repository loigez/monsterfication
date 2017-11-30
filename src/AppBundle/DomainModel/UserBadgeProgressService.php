<?php

namespace AppBundle\DomainModel;

use AppBundle\Entity\Badge;
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
            $badgesToUser->setState(0);
            $badgesToUser->setProgress(0);
            $badgesToUser->setBadge($badge);
            $this->entityManager->persist($badgesToUser);
        }

        $this->entityManager->flush();
    }

    public function persist(UserBadgeProgress $progressBadge)
    {
        $this->entityManager->persist($progressBadge);
        $this->entityManager->flush();
    }




}