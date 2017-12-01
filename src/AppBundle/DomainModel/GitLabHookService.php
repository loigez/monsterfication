<?php

namespace AppBundle\DomainModel;

use AppBundle\Entity\Commit;
use AppBundle\Entity\Rules\Rule;
use AppBundle\Entity\UserBadgeProgress;
use Carbon\Carbon as DateTime;
use Doctrine\Common\Collections\ArrayCollection;

class GitLabHookService
{
    const PROJECT_NAME_PROJECT_ID_PATTERN = '/^(\w+)-(\d+)\s+/';
    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var ArrayCollection
     */
    private $commitCollection;

    /**
     * @var UserBadgeProgressService
     */
    private $userBadgeProgressService;
    /**
     * @var CommitService
     */
    private $commitService;

    /**
     * BadgeService constructor.
     * @param UserService $userService
     * @param UserBadgeProgressService $userBadgeProgressService
     * @param CommitService $commitService
     */
    public function __construct(
        UserService $userService,
        UserBadgeProgressService $userBadgeProgressService,
        CommitService $commitService
    )
    {
        $this->userService = $userService;
        $this->userBadgeProgressService = $userBadgeProgressService;
        $this->commitService = $commitService;
    }

    public function parseGitLabHook(string $payload)
    {
        $json = json_decode($payload, true);
        $collection = new ArrayCollection();
        foreach ($json['commits'] as $commitItem) {
            if (preg_match(self::PROJECT_NAME_PROJECT_ID_PATTERN, $commitItem['message'], $matches) === 0
                || $this->commitService->isCommitHash($commitItem['id'])
            ) {
                continue;
            }

            $commit = new Commit(
                $commitItem['id'],
                DateTime::createFromFormat(DateTime::ATOM, $commitItem['timestamp']),
                $commitItem['author']['email'],
                $matches[1],
                $matches[2]
            );

            $this->commitService->save($commit);
            $collection->add($commit);

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
                /**
                 * @var Rule $rule
                 */
                $rule = new $ruleName($progressBadge, $commit);

                $this->userBadgeProgressService->persist($rule->updateProgress());
            }
        }
    }

}