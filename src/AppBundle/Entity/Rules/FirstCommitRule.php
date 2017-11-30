<?php

namespace AppBundle\Entity\Rules;

use AppBundle\DomainModel\Commit;
use AppBundle\Entity\UserBadgeProgress;

class FirstCommitRule
{
    /**
     * @var UserBadgeProgress
     */
    private $progressBadge;
    /**
     * @var Commit
     */
    private $commit;

    /**
     * FirstCommitRule constructor.
     * @param UserBadgeProgress $progressBadge
     * @param Commit $commit
     */
    public function __construct(UserBadgeProgress $progressBadge, Commit $commit)
    {
        $this->progressBadge = $progressBadge;
        $this->commit = $commit;
    }

    public function updateProgress()
    {
        return ;
    }


}