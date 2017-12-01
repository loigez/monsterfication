<?php

namespace AppBundle\Entity\Rules;

use AppBundle\Entity\UserBadgeProgress;

class MakeCommitsNumber extends Rule
{

    public function updateProgress(): UserBadgeProgress
    {
        $this->progressBadge->incrementProgressByOne();

        $this->unlockOnTargetAchieved();

        return $this->progressBadge;
    }


}