<?php

namespace AppBundle\DomainModel;

class Commit
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var \DateTime
     */
    private $date;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $projectCodeName;
    /**
     * @var string
     */
    private $taskId;

    /**
     * Commit constructor.
     * @param int $id
     * @param \DateTime $date
     * @param string $email
     * @param string $projectCodeName
     * @param string $taskId
     */
    public function __construct($id, \DateTime $date, $email, $projectCodeName, $taskId)
    {
        $this->id = $id;
        $this->date = $date;
        $this->email = $email;
        $this->projectCodeName = $projectCodeName;
        $this->taskId = $taskId;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
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