<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

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
     */
    private $user;

    /**
     * Many UserBadgeProgresses have One Badge.
     * @ManyToOne(targetEntity="Badge", inversedBy="userBadgeProgresses", fetch="EAGER")
     * @JoinColumn(name="badge_id", referencedColumnName="id")
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
     * @return mixed
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



}