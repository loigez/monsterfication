<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use \DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_badge_progress")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserBadgeProgressRepository")
 */
class UserBadgeProgress
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * Many UserBadgeProgresses have One User.
     * @ManyToOne(targetEntity="User", inversedBy="userBadgeProgresses", fetch="EAGER")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     * @var User
     */
    private $user;

    /**
     * Many UserBadgeProgresses have One Badge.
     * @ManyToOne(targetEntity="Badge", inversedBy="userBadgeProgresses", fetch="EAGER")
     * @JoinColumn(name="badge_id", referencedColumnName="id")
     * @var Badge
     */
    private $badge;
    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $state;
    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $progress;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var DateTime
     */
    private $unlockDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var DateTime
     */
    private $changeDate;

    /**
     * @return DateTime
     */
    public function getChangeDate(): DateTime
    {
        return $this->changeDate;
    }

    /**
     * @param DateTime $changeDate
     */
    public function setChangeDate(DateTime $changeDate)
    {
        $this->changeDate = $changeDate;
    }

    /**
     * @return DateTime
     */
    public function getUnlockDate()
    {
        return $this->unlockDate;
    }

    /**
     * @param DateTime $date
     */
    public function setUnlockDate($date)
    {
        $this->unlockDate = $date;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return Badge
     */
    public function getBadge()
    {
        return $this->badge;
    }

    /**
     * @param mixed $badge
     */
    public function setBadge($badge)
    {
        $this->badge = $badge;
    }

    /**
     * @return int
     */
    public function getState(): int
    {
        return $this->state;
    }

    /**
     * @return bool
     */
    public function isLocked(): bool
    {
        return State::LOCKED === $this->state;
    }

    /**
     * @return bool
     */
    public function isUnlocked(): bool
    {
        return !$this->isLocked();
    }

    /**
     * @param int $state
     */
    public function setState(int $state)
    {
        $this->state = $state;
    }

    /**
     * @return int
     */
    public function getProgress(): int
    {
        return $this->progress;
    }

    /**
     * @param int $progress
     */
    public function setProgress(int $progress)
    {
        $this->progress = $progress;
    }


    public function incrementProgressByOne()
    {
        $this->incrementProgressBy(1);
    }

    public function incrementProgressBy(int $increment)
    {
        $this->progress += $increment;
    }

    public function unlockBadge()
    {
        $this->setState(State::UNLOCKED);
        $this->setUnlockDate(new DateTime());
    }



}