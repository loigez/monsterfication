<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Badge;
use AppBundle\Entity\State;
use AppBundle\Entity\User;
use AppBundle\Entity\UserBadgeProgress;
use DateTime;
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

    const USERS = [
        'tomasz.galinski',
        'maciej.jackowski',
        'tomasz.majcher',
        'grzegorz.laskowski',
        'pawel.basiak'
    ];

    const BADGES = [
        ['description' => 'Make Your first commit (0/1) ', 'name' => 'Baby steps', 'ruleName'=>'BabyStepsRule', 'target'=> 1],
        ['description' => 'Make 100 commits (0/100) ', 'name' => 'Good job youngster!', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => 'Make 1000 commits (0/1000) ', 'name' => 'Rising star', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => 'Make 10000 commits (0/10000) ', 'name' => 'Hero', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => 'Make 10 commits to a single task (0/10) ', 'name' => 'Atomic commiter', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => 'Be not the only one contributor of the task (0/10) ', 'name' => 'Multiplayer', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => 'Push more than one commit at once (0/100) ', 'name' => 'Combo Breaker', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => 'Make commit at night (22 - 6) (0/10) ', 'name' => 'Owl', 'ruleName'=>'FakeRule', 'target'=> 1],
        [
            'description' => 'Make commit everyday through whole month (Mon - Fri) ',
            'name' => 'Employee of the month ;)', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => 'Make commit after 30 days of inactivity ', 'name' => 'Welcome back!', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => 'Make 1000 commits in project GRREDISIGN ', 'name' => 'New World Order', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => 'Make 1000 commits in project GRBACKEND ', 'name' => 'Dungeon Keeper', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => 'Make 1000 commits in project GRALPHA ', 'name' => 'Alpha Male', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => 'Make 1000 commits in project GRBRAVO ', 'name' => 'Bravo Commando', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => 'Make 1000 commits in project GRAPI ', 'name' => 'Interface Lord', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => 'Make 1000 commits in project GRHYDRA ', 'name' => 'Beast Master', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => 'Make 1000 commits in project GRCRM ', 'name' => 'Dancing with stars', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => 'Make 1000 commits in project GRAUTOMATION ', 'name' => 'RoboCop', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => 'Finish onboarding ', 'name' => 'Welcome on board!', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => '1st year work anniversay ', 'name' => 'First anniversary', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => '3rd year work anniversay ', 'name' => 'Hat trick', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => '5th year work anniversay ', 'name' => 'Experienced player', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => '10th year work anniversay ', 'name' => 'Mathusalem', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => 'Register first cycling training in GRMondo ', 'name' => 'Tricycle', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => 'Register first running training in GRMondo ', 'name' => 'Run Forest run!!!', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => 'Register 100 cycling trainings in GRMondo ', 'name' => 'Pro Cyclist', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => 'Register 100 running trainings in GRMondo ', 'name' => 'Pro Runner', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => 'Participate in Masurian Getaway Party 2017 ', 'name' => 'Masurian Getaway Party 2017', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => 'Participate in Monster\'s Insomnia 2017 ', 'name' => 'Monster\'s Insomnia 2017', 'ruleName'=>'FakeRule', 'target'=> 1],
        ['description' => 'Snap Edit Hashtag winner ', 'name' => 'Photo of the month', 'ruleName'=>'FakeRule', 'target'=> 1],
    ];
    const USERS_NUMBER = 5;
    const MAX_USER_BADGES_NUMBER = 6;

    public function load(ObjectManager $manager)
    {
        foreach (self::BADGES as $id => $badgeItem) {
            $badge = new Badge();
            $badge->setName($badgeItem['name']);
            $badge->setDescription($badgeItem['description']);
            $badge->setRule($badgeItem['ruleName']);
            $badge->setTarget($badgeItem['target']);
            $badge->setIconName(self::ICONS[random_int(0, count(self::ICONS) - 1)]);
            $this->addReference('badge-progress-' . $id, $badge);
            $manager->persist($badge);
        }
        $manager->flush();

        $userNumber =  count(self::USERS);
        for ($i = 0; $i <  $userNumber; $i++) {
            $user = new User();
            $user->setEmail(self::USERS[$i] . '@getresponse.com');
            $user->setUsername(self::USERS[$i]);
            $user->setNickname('nick ' . self::USERS[$i]);
            $user->setPassword('$2y$13$BOaEVAJskV62ygw5ICSIsuL03oK4oON6.aXHfq4TnTOxG5COe1f7e');
            $this->addReference('user-progress-' . $i, $user);
            $manager->persist($user);
        }
        $manager->flush();

        foreach (self::USERS as $userIndex => $user) {
            foreach (self::BADGES as $badgeIndex => $badge) {
                $progress = new UserBadgeProgress();
                $progress->setBadge($this->getReference('badge-progress-' . $badgeIndex));
                $progress->setUser($this->getReference('user-progress-' . $userIndex));
                $progress->setState(State::LOCKED);
                $progress->setProgress(0);
                $manager->persist($progress);
            }
        }
        $manager->flush();

    }

}