<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Carbon\Carbon as DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="commit")
 */
class Commit
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var DateTime
     */
    private $date;
    /**
     * @ORM\Column(type="string", length=256)
     * @var string
     */
    private $email;
    /**
     * @ORM\Column(type="string", length=20)
     * @var string
     */
    private $projectCodeName;
    /**
     * @ORM\Column(type="string", length=20)
     * @var string
     */
    private $taskId;
    /**
     * @ORM\Column(type="string", length=80)
     * @var string
     */
    private $commitHash;

    /**
     * Commit constructor.
     * @param string $commitHash
     * @param DateTime $date
     * @param string $email
     * @param string $projectCodeName
     * @param string $taskId
     */
    public function __construct($commitHash, DateTime $date, $email, $projectCodeName, $taskId)
    {
        $this->commitHash = $commitHash;
        $this->date = $date;
        $this->email = $email;
        $this->projectCodeName = $projectCodeName;
        $this->taskId = $taskId;
    }

    /**
     * @return string
     */
    public function getCommitHash(): string
    {
        return $this->commitHash;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getProjectCodeName(): string
    {
        return $this->projectCodeName;
    }

    /**
     * @return string
     */
    public function getTaskId(): string
    {
        return $this->taskId;
    }


}