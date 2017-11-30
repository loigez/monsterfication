<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * @ORM\Entity
 * @ORM\Table(name="badge")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BadgeRepository")
 */
class Badge
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=256)
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $target;

    /**
     * @ORM\Column(type="string", length=1024)
     * @var string
     */
    private $iconName;

    /**
     * One Badge has Many UserBadgeProgresses.
     * @OneToMany(targetEntity="UserBadgeProgress", mappedBy="badge")
     */
    private $userBadgeProgresses;

    /**
     * @ORM\Column(type="string", length=256)
     * @var string
     */
    private $rule;

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
     * @return string
     */
    public function getName(): string
    {
        return (string)$this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return (string)$this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getUserBadgeProgresses()
    {
        return $this->userBadgeProgresses;
    }

    /**
     * @param mixed $userBadgeProgresses
     */
    public function setUserBadgeProgresses($userBadgeProgresses)
    {
        $this->userBadgeProgresses = $userBadgeProgresses;
    }

    /**
     * @return string
     */
    public function getRule(): string
    {
        return (string)$this->rule;
    }

    /**
     * @param string $rule
     */
    public function setRule(string $rule)
    {
        $this->rule = $rule;
    }

    /**
     * @return string
     */
    public function getIconName()
    {
        return $this->iconName;
    }

    /**
     * @param string $iconName
     */
    public function setIconName($iconName)
    {
        $this->iconName = $iconName;
    }


    /**
     * @return int
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param int $target
     */
    public function setTarget($target)
    {
        $this->target = $target;
    }


}