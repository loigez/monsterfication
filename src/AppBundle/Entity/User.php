<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * One User has Many UserBadgeProgresses.
     * @OneToMany(targetEntity="UserBadgeProgress", mappedBy="user")
     * @var ArrayCollection
     */
    private $userBadgeProgresses;

    /**
     * @ORM\Column(type="string", length=512)
     * @var string
     */
    private $email;
    /**
     * @ORM\Column(type="string", length=512)
     * @var int
     */
    private $role;
    /**
     * @ORM\Column(type="string", length=512)
     * @var string
     */
    private $userName;
    /**
     * @ORM\Column(type="string", length=512)
     * @var string
     */
    private $nickname;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->userBadgeProgresses = new ArrayCollection();
    }

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
    public function getAllProgressBadges()
    {
        return $this->userBadgeProgresses;
    }

    /**
     * @param mixed $userBadgeProgresses
     */
    public function setAllProgressBadges($userBadgeProgresses)
    {
        $this->userBadgeProgresses = $userBadgeProgresses;
    }

    /**
     * @return UserBadgeProgress
     */
    public function getProgressById(int $progressId)
    {
        return $this->userBadgeProgresses->get($progressId);
    }

    /**
     * @param UserBadgeProgress $userBadgeProgresses
     */
    public function addProgress($userBadgeProgresses)
    {
        $this->userBadgeProgresses->set($userBadgeProgresses->getId(), $userBadgeProgresses);
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getRole(): int
    {
        return $this->role;
    }

    /**
     * @param int $role
     */
    public function setRole(int $role)
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName(string $userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @param string $nickname
     */
    public function setNickname(string $nickname)
    {
        $this->nickname = $nickname;
    }

}