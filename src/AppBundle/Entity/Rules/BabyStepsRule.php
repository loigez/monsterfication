<?php

namespace AppBundle\Entity\Rules;

use AppBundle\DomainModel\Commit;
use AppBundle\Entity\State;
use AppBundle\Entity\UserBadgeProgress;

class BabyStepsRule
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
     * BabyStepsRule constructor.
     * @param UserBadgeProgress $progressBadge
     * @param Commit $commit
     */
    public function __construct(UserBadgeProgress $progressBadge, Commit $commit)
    {
        $this->progressBadge = $progressBadge;
        $this->commit = $commit;
    }

    public function updateProgress(): UserBadgeProgress
    {
        $this->progressBadge->setState(State::UNLOCKED);
        $this->progressBadge->setProgress($this->progressBadge->getBadge()->getTarget());
        return $this->progressBadge;
    }


}