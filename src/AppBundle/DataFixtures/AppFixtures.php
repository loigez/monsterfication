<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Badge;
use AppBundle\Entity\User;
use AppBundle\Entity\UserBadgeProgress;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    const ICONS = [
        'baby_step',
        'lock',
        'monster_insomnia_2017',
        'run_forest_run',
    ];

    const BADGES = [
        ['description' => 'Make Your first commit (0/1) ', 'name' => 'Baby steps'],
        ['description' => 'Make 100 commits (0/100) ', 'name' => 'Good job youngster!'],
        ['description' => 'Make 1000 commits (0/1000) ', 'name' => 'Rising star'],
        ['description' => 'Make 10000 commits (0/10000) ', 'name' => 'Hero'],
        ['description' => 'Make 10 commits to a single task (0/10) ', 'name' => 'Atomic commiter'],
        ['description' => 'Be not the only one contributor of the task (0/10) ', 'name' => 'Multiplayer'],
        ['description' => 'Push more than one commit at once (0/100) ', 'name' => 'Combo Breaker'],
        ['description' => 'Make commit at night (22 - 6) (0/10) ', 'name' => 'Owl'],
        [
            'description' => 'Make commit everyday through whole month (Mon - Fri) ',
            'name' => 'Employee of the month ;)'
        ],
        ['description' => 'Make commit after 30 days of inactivity ', 'name' => 'Welcome back!'],
        ['description' => 'Make 1000 commits in project GRREDISIGN ', 'name' => 'New World Order'],
        ['description' => 'Make 1000 commits in project GRBACKEND ', 'name' => 'Dungeon Keeper'],
        ['description' => 'Make 1000 commits in project GRALPHA ', 'name' => 'Alpha Male'],
        ['description' => 'Make 1000 commits in project GRBRAVO ', 'name' => 'Bravo Commando'],
        ['description' => 'Make 1000 commits in project GRAPI ', 'name' => 'Interface Lord'],
        ['description' => 'Make 1000 commits in project GRHYDRA ', 'name' => 'Beast Master'],
        ['description' => 'Make 1000 commits in project GRCRM ', 'name' => 'Dancing with stars'],
        ['description' => 'Make 1000 commits in project GRAUTOMATION ', 'name' => 'RoboCop'],
        ['description' => 'Finish onboarding ', 'name' => 'Welcome on board!'],
        ['description' => '1st year work anniversay ', 'name' => 'First anniversary'],
        ['description' => '3rd year work anniversay ', 'name' => 'Hat trick'],
        ['description' => '5th year work anniversay ', 'name' => 'Experienced player'],
        ['description' => '10th year work anniversay ', 'name' => 'Mathusalem'],
        ['description' => 'Register first cycling training in GRMondo ', 'name' => 'Tricycle'],
        ['description' => 'Register first running training in GRMondo ', 'name' => 'Run Forest run!!!'],
        ['description' => 'Register 100 cycling trainings in GRMondo ', 'name' => 'Pro Cyclist'],
        ['description' => 'Register 100 running trainings in GRMondo ', 'name' => 'Pro Runner'],
        ['description' => 'Participate in Masurian Getaway Party 2017 ', 'name' => 'Masurian Getaway Party 2017'],
        ['description' => 'Participate in Monster\'s Insomnia 2017 ', 'name' => 'Monster\'s Insomnia 2017'],
        ['description' => 'Snap Edit Hashtag winner ', 'name' => 'Photo of the month'],
    ];
    const USERS_NUMBER = 5;
    const MAX_USER_BADGES_NUMBER = 6;

    public function load(ObjectManager $manager)
    {
        foreach (self::BADGES as $id => $badgeItem) {
            $badge = new Badge();
            $badge->setName($badgeItem['name']);
            $badge->setDescription($badgeItem['description']);
            $badge->setRule('AddByHandRule');
            $badge->setTarget(100);
            $badge->setIconName(self::ICONS[random_int(0, count(self::ICONS) - 1)]);
            $this->addReference('badge-progress-' . $id, $badge);
            $manager->persist($badge);
        }
        $manager->flush();

        for ($i = 0; $i < self::USERS_NUMBER; $i++) {
            $user = new User();
            $user->setEmail("mosterfication_{$i}@getresponse.com");
            $user->setUsername("username {$i}");
            $user->setNickname("nickname {$i}");
            $user->setPassword('');
            $this->addReference('user-progress-' . $i, $user);
            $manager->persist($user);
        }
        $manager->flush();

        $badgeNumber = random_int(1, self::MAX_USER_BADGES_NUMBER);
        $badgeStart = random_int(0, count(self::BADGES) - self::MAX_USER_BADGES_NUMBER);
        for ($i = 0; $i < self::USERS_NUMBER; $i++) {
            for ($b = $badgeStart; $b < $badgeStart + $badgeNumber; $b++) {
                $progress = new UserBadgeProgress();
                $progress->setBadge($this->getReference('badge-progress-' . $b));
                $progress->setUser($this->getReference('user-progress-' . $i));
                $progress->setState(random_int(1, 3));
                $progress->setProgress(random_int(1, 100));
                $manager->persist($progress);
            }
        }
        $manager->flush();

    }

}