<?php

namespace AppBundle\DomainModel;

use AppBundle\Entity\Rules\BabyStepsRule;
use AppBundle\Entity\UserBadgeProgress;
use Carbon\Carbon as DateTime;
use Doctrine\Common\Collections\ArrayCollection;

class GitLabHookService
{
    /**
     * @var UserService
     */
    private $userService;
    /**
     * @var BadgeService
     */
    private $badgeService;
    /**
     * @var ArrayCollection
     */
    private $commitCollection;
    /**
     * @var UserBadgeProgressService
     */
    private $userBadgeProgressService;

    /**
     * BadgeService constructor.
     */
    public function __construct(UserService $userService, UserBadgeProgressService $userBadgeProgressService)
    {
        $this->userService = $userService;
        $this->userBadgeProgressService = $userBadgeProgressService;
    }

    public function parseGitLabHook(string $payload)
    {
        $json = json_decode($payload, true);
        $collection = new ArrayCollection();
        foreach ($json['commits'] as $commitItem) {
            if (preg_match('/^(\w+)-(\d+)\s+/', $commitItem['message'], $matches) === 0) {
                continue;
            }
            $collection->add(new Commit(
                $commitItem['id'],
                DateTime::createFromFormat(DateTime::ATOM, $commitItem['timestamp']),
                $commitItem['author']['email'],
                $matches[1][0],
                $matches[2][0]
            ));

        }

        $this->commitCollection = $collection;
    }

    public function applyBadgeRules()
    {
        /**
         * @var Commit $commit
         */
        foreach ($this->commitCollection->getIterator() as $commit) {
            $user = $this->userService->getByEmail($commit->getEmail());
            foreach ($user->getAllProgressBadges() as $progressBadge) {
                /**
                 * @var UserBadgeProgress $progressBadge
                 */
                if ($progressBadge->isUnlocked()) {
                    continue;
                }
                $ruleName = 'AppBundle\Entity\Rules\\' . $progressBadge->getBadge()->getRule();
                $rule = new $ruleName($progressBadge, $commit);

                $this->userBadgeProgressService->persist($rule->updateProgress());
            }
        }
    }

}