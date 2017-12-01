<?php

namespace AppBundle\Entity\Rules;

use AppBundle\Entity\UserBadgeProgress;

class OwlRule extends Rule
{

    public function updateProgress(): UserBadgeProgress
    {
        if ($this->commit->getDate()->hour >= 22 && $this->commit->getDate()->hour <= 6) {
            $this->progressBadge->incrementProgressByOne();
        }

        $this->unlockOnTargetAchieved();

        return $this->progressBadge;
    }


}