<?php

namespace AppBundle\Entity\Rules;

use AppBundle\Entity\State;
use AppBundle\Entity\UserBadgeProgress;
use DateTime;

class BabyStepsRule extends Rule
{

    public function updateProgress(): UserBadgeProgress
    {
        $this->progressBadge->setState(State::UNLOCKED);
        $this->progressBadge->setUnlockDate(new DateTime());
        $this->progressBadge->setProgress($this->progressBadge->getBadge()->getTarget());

        return $this->progressBadge;
    }


}