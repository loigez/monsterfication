<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="integer")
     * @var int
     */
    private $userId;
    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $badgeId;
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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getBadgeId(): int
    {
        return $this->badgeId;
    }

    /**
     * @param int $badgeId
     */
    public function setBadgeId(int $badgeId)
    {
        $this->badgeId = $badgeId;
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