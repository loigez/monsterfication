<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Badge;
use AppBundle\Entity\User;
use AppBundle\Entity\UserBadgeProgress;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    const BADGES = [
        'Baby steps',
        'Good job kid!',
        'Rising star',
        'Hero',
        'Atomic commiter',
        'Multiplayer/Teamplayer',
        'Combo Breaker',
        'Owl',
        'Employee of the month ;)',
        'New World Order',
        'Dungeon Keeper',
        'Alpha Commando',
        'Bravo Commando',
        'Interface Lord',
        'Beast Master',
        'Dancing with stars',
        'RoboCop',
    ];
    const USERS_NUMBER = 5;
    const MAX_USER_BADGES_NUMBER = 6;

    public function load(ObjectManager $manager)
    {
        $badges = [];
        foreach (self::BADGES as $id => $name) {
            $badge = new Badge();
            $badge->setName($name);
            $badge->setDescription('What you need to achive ' . $name . 'is to do ' . $id . ' tasks');
            $badge->setRule('AddByHandRule');
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