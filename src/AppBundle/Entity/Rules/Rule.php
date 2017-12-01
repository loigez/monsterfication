<?php

namespace AppBundle\Entity\Rules;

use AppBundle\Entity\Commit;
use AppBundle\Entity\UserBadgeProgress;
use Wowapps\SlackBundle\DTO\SlackMessage;
use Wowapps\SlackBundle\Service\SlackBot;

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
     * @var SlackBot
     */
    private $slackBot;

    /**
     * @param UserBadgeProgress $progressBadge
     * @param Commit $commit
     */
    public function __construct(UserBadgeProgress $progressBadge, Commit $commit, SlackBot $slackBot)
    {
        $this->progressBadge = $progressBadge;
        $this->commit = $commit;
        $this->slackBot = $slackBot;
    }

    protected function unlockOnTargetAchieved()
    {
        if ($this->progressBadge->getProgress() >= $this->progressBadge->getBadge()->getTarget()) {
            $this->progressBadge->unlockBadge();
            $slackMessage = new SlackMessage();

            $slackMessage
                ->setIcon('http://monster-5.monsters-insomnia.com/favicon.png')
                ->setText(sprintf('%s unlocked %s', $this->commit->getEmail(), $this->progressBadge->getBadge()->getName()))
                ->setRecipient('monsterfication')
                ->setSender('Monster Pad')
            ;
            $this->slackBot->sendMessage($slackMessage);
        }
    }

    public function updateProgress(): UserBadgeProgress
    {
        return $this->progressBadge;
    }

}