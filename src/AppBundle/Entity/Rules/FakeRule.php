<?php

namespace AppBundle\Entity\Rules;

use AppBundle\Entity\State;
use AppBundle\Entity\UserBadgeProgress;
use DateTime;

class FakeRule extends Rule
{

    public function updateProgress(): UserBadgeProgress
    {
        return $this->progressBadge;
    }


}