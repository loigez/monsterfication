<?php

namespace AppBundle\Entity\Rules;

use AppBundle\Entity\UserBadgeProgress;

class MakeCommitsNumberInProjectRule extends Rule
{
    const PROJECT_CODE_NAME = '';

    public function updateProgress(): UserBadgeProgress
    {
        if ($this->commit->getProjectCodeName() === static::PROJECT_CODE_NAME) {
            $this->progressBadge->incrementProgressByOne();
        }

        $this->unlockOnTargetAchieved();

        return $this->progressBadge;
    }


}