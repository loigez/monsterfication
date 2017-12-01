<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * One User has Many UserBadgeProgresses.
     * @OneToMany(targetEntity="UserBadgeProgress", mappedBy="user")
     * @ORM\OrderBy({"state" = "desc", "progress" = "desc"})
     * @var ArrayCollection
     */
    private $userBadgeProgresses;
    /**
     * @ORM\Column(type="string", length=512)
     *
     * @Assert\NotBlank(message="Please enter your nickname.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The nickname is too short.",
     *     maxMessage="The nickname is too long.",
     *     groups={"Registration", "Profile"}
     * )
     * @var string
     */
    protected $nickname;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->userBadgeProgresses = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return ArrayCollection
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
    public function getNickname(): string
    {
        return (string)$this->nickname;
    }

    /**
     * @param string $nickname
     */
    public function setNickname(string $nickname)
    {
        $this->nickname = $nickname;
    }

}