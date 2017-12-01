<?php

namespace AppBundle\Entity\Rules;

use AppBundle\Entity\Commit;
use AppBundle\Entity\UserBadgeProgress;

abstract class Rule
{
    /**
     * @var UserBadgeProgress
     */
    protected $progressBadge;
    /**
     * @var Commit
     */
    protected $commit;

    /**
     * @param UserBadgeProgress $progressBadge
     * @param Commit $commit
     */
    public function __construct(UserBadgeProgress $progressBadge, Commit $commit)
    {
        $this->progressBadge = $progressBadge;
        $this->commit = $commit;
    }

    protected function unlockOnTargetAchieved()
    {
        if ($this->progressBadge->getProgress() >= $this->progressBadge->getBadge()->getTarget()) {
            $this->progressBadge->unlockBadge();
        }
    }

    public function updateProgress(): UserBadgeProgress
    {
        return $this->progressBadge;
    }

}