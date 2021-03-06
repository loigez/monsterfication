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
     * @return mixed
     */
    public function lastActivity()
    {
        return $this->entityManager->getRepository(UserBadgeProgress::class)->findLastActivity();
    }

    /**
     * @return mixed
     */
    public function topTen()
    {
        return $this->entityManager->getRepository(UserBadgeProgress::class)->findTopTen();
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
     * @param User[] $users
     * @param Badge $badge
     */
    public function assignBadgeToUsers(array $users, Badge $badge)
    {
        foreach ($users as $user) {
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
     * @param int $id
     */
    public function activateUsersBadge($id)
    {
        $badgesToUser = $this->entityManager
            ->getRepository(UserBadgeProgress::class)
            ->find($id);

        /** @var Badge $badge */
        $badge = $badgesToUser->getBadge();

        $badgesToUser->setState(State::UNLOCKED);
        $badgesToUser->setProgress($badge->getTarget());
        $badgesToUser->setUnlockDate(new \DateTime());
        $this->entityManager->persist($badgesToUser);
        $this->entityManager->flush();
    }

    /**
     * @param int $id
     */
    public function unActivateUsersBadge($id)
    {
        $badgesToUser = $this->entityManager
            ->getRepository(UserBadgeProgress::class)
            ->find($id);

        $badgesToUser->setState(State::LOCKED);
        $badgesToUser->setProgress(0);
        $badgesToUser->setUnlockDate(null);
        $this->entityManager->persist($badgesToUser);
        $this->entityManager->flush();
    }


    public function persist(UserBadgeProgress $progressBadge)
    {
        $this->entityManager->persist($progressBadge);
        $this->entityManager->flush();
    }

    /**
     * @param int $id
     * @return null|object
     */
    public function getById($id)
    {
        return $this->entityManager->getRepository(UserBadgeProgress::class)->find($id);
    }

    /**
     * @param Badge $badge
     * @return null|object
     */
    public function getByBadge(Badge $badge)
    {
        return $this->entityManager->getRepository(UserBadgeProgress::class)
            ->findBy(array('badge' => $badge));
    }

    /**
     * @param UserBadgeProgress[] $userBadgeProgress
     */
    public function unasigneBadgeFromUsers(array $userBadgeProgress)
    {
        foreach ($userBadgeProgress as $progress) {
            $this->entityManager->remove($progress);
        }

        $this->entityManager->flush();
    }


}