<?php

namespace AppBundle\Entity\Rules;

use AppBundle\Entity\UserBadgeProgress;

class BabyStepsRule extends Rule
{

    public function updateProgress(): UserBadgeProgress
    {
        $this->progressBadge->unlockBadge();
        $this->progressBadge->setProgress($this->progressBadge->getBadge()->getTarget());

        return $this->progressBadge;
    }


}