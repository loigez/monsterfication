<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Badge;
use AppBundle\Entity\State;
use AppBundle\Entity\User;
use AppBundle\Entity\UserBadgeProgress;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    const USERS = [
        'tomasz.galinski',
        'maciej.jackowski',
        'tomasz.majcher',
        'grzegorz.laskowski',
        'pawel.basiak',
        'maciej.gerlecki',
        'lukasz.czajka'
    ];

    const BADGES = [
        ['description' => 'Make Your first commit', 'name' => 'Baby steps', 'ruleName'=>'BabyStepsRule', 'target'=> 1, 'iconName' => 'baby_step'],
        ['description' => 'Make 100 commits ', 'name' => 'Good job youngster!', 'ruleName'=>'MakeCommitsNumber', 'target'=> 2, 'iconName' => 'good_job_kid'],
        ['description' => 'Make 1000 commits ', 'name' => 'Rising star', 'ruleName'=>'MakeCommitsNumber', 'target'=> 3, 'iconName' => 'atomic_commiter'],
        ['description' => 'Make 10000 commits ', 'name' => 'Hero', 'ruleName'=>'MakeCommitsNumber', 'target'=> 4, 'iconName' => 'atomic_commiter'],
        ['description' => 'Make 10 commits to a single task', 'name' => 'Atomic commiter', 'ruleName'=>'FakeRule', 'target'=> 1, 'iconName' => 'atomic_commiter'],
        ['description' => 'Be not the only one contributor of the task', 'name' => 'Multiplayer', 'ruleName'=>'FakeRule', 'target'=> 1, 'iconName' => 'atomic_commiter'],
        ['description' => 'Push more than one commit at once (0/100) ', 'name' => 'Combo Breaker', 'ruleName'=>'FakeRule', 'target'=> 1, 'iconName' => 'atomic_commiter'],
        ['description' => 'Make commit at night (22 - 6)', 'name' => 'Owl', 'ruleName'=>'OwlRule', 'target'=> 2, 'iconName' => 'atomic_commiter'],
        [
            'description' => 'Make commit everyday through whole month (Mon - Fri) ',
            'name' => 'Employee of the month ;)', 'ruleName'=>'FakeRule', 'target'=> 1, 'iconName' => 'atomic_commiter'],
        ['description' => 'Make commit after 30 days of inactivity ', 'name' => 'Welcome back!', 'ruleName'=>'FakeRule', 'target'=> 1, 'iconName' => 'atomic_commiter'],
        ['description' => 'Make 1000 commits in project GRREDESIGN ', 'name' => 'New World Order', 'ruleName'=>'MakeCommitsNumberInGrRedesignRule', 'target'=> 2, 'iconName' => 'atomic_commiter'],
        ['description' => 'Make 1000 commits in project GRBACKEND ', 'name' => 'Dungeon Keeper', 'ruleName'=>'MakeCommitsNumberInGrBackendRule', 'target'=> 2, 'iconName' => 'atomic_commiter'],
        ['description' => 'Make 1000 commits in project GRALPHA ', 'name' => 'Alpha Male', 'ruleName'=>'MakeCommitsNumberInGrAlphaRule', 'target'=> 2, 'iconName' => 'atomic_commiter'],
        ['description' => 'Make 1000 commits in project GRBRAVO ', 'name' => 'Bravo Commando', 'ruleName'=>'MakeCommitsNumberInGrBravoRule', 'target'=> 2, 'iconName' => 'atomic_commiter'],
        ['description' => 'Make 1000 commits in project GRAPI ', 'name' => 'Interface Lord', 'ruleName'=>'MakeCommitsNumberInGrApiRule', 'target'=> 2, 'iconName' => 'atomic_commiter'],
        ['description' => 'Make 1000 commits in project GRHYDRA ', 'name' => 'Beast Master', 'ruleName'=>'MakeCommitsNumberInGrHydraRule', 'target'=> 2, 'iconName' => 'atomic_commiter'],
        ['description' => 'Make 1000 commits in project GRCRM ', 'name' => 'Dancing with stars', 'ruleName'=>'MakeCommitsNumberInGrCrmRule', 'target'=> 2, 'iconName' => 'atomic_commiter'],
        ['description' => 'Make 1000 commits in project GRAUTOMATION ', 'name' => 'RoboCop', 'ruleName'=>'MakeCommitsNumberInGrAutomationRule', 'target'=> 2, 'iconName' => 'atomic_commiter'],
        ['description' => 'Finish onboarding ', 'name' => 'Welcome on board!', 'ruleName'=>'FakeRule', 'target'=> 1, 'iconName' => 'atomic_commiter'],
        ['description' => '1st year work anniversay ', 'name' => 'First anniversary', 'ruleName'=>'FakeRule', 'target'=> 1, 'iconName' => 'first_anniversary'],
        ['description' => '3rd year work anniversay ', 'name' => 'Hat trick', 'ruleName'=>'FakeRule', 'target'=> 1, 'iconName' => 'hat_trick'],
        ['description' => '5th year work anniversay ', 'name' => 'Experienced player', 'ruleName'=>'FakeRule', 'target'=> 1, 'iconName' => 'atomic_commiter'],
        ['description' => '10th year work anniversay ', 'name' => 'Mathusalem', 'ruleName'=>'FakeRule', 'target'=> 1, 'iconName' => 'atomic_commiter'],
        ['description' => 'Register first cycling training in GRMondo ', 'name' => 'Tricycle', 'ruleName'=>'FakeRule', 'target'=> 1, 'iconName' => 'tricycle'],
        ['description' => 'Register first running training in GRMondo ', 'name' => 'Run Forrest run!!!', 'ruleName'=>'FakeRule', 'target'=> 1, 'iconName' => 'run_forrest_run'],
        ['description' => 'Register 100 cycling trainings in GRMondo ', 'name' => 'Pro Cyclist', 'ruleName'=>'FakeRule', 'target'=> 1, 'iconName' => 'pro_cyclist'],
        ['description' => 'Register 100 running trainings in GRMondo ', 'name' => 'Pro Runner', 'ruleName'=>'FakeRule', 'target'=> 1, 'iconName' => 'atomic_commiter'],
        ['description' => 'Participate in Masurian Getaway Party 2017 ', 'name' => 'Masurian Getaway Party 2017', 'ruleName'=>'FakeRule', 'target'=> 1, 'iconName' => 'atomic_commiter'],
        ['description' => 'Participate in Monster\'s Insomnia 2017 ', 'name' => 'Monster\'s Insomnia 2017', 'ruleName'=>'FakeRule', 'target'=> 1, 'iconName' => 'monster_insomnia_2017'],
        ['description' => 'Snap Edit Hashtag winner ', 'name' => 'Photo of the month', 'ruleName'=>'FakeRule', 'target'=> 1, 'iconName' => 'atomic_commiter'],
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
            $badge->setIconName($badgeItem['iconName']);
            $this->addReference('badge-progress-' . $id, $badge);
            $manager->persist($badge);
        }
        $manager->flush();

        $userNumber =  count(self::USERS);
        for ($i = 0; $i <  $userNumber; $i++) {
            $user = new User();
            $user->setEmail(self::USERS[$i] . '@getresponse.com');
            $user->setUsername(self::USERS[$i]);
            $user->setEnabled(true);
            $user->setRoles(['ROLE_ADMIN']);
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
                if (5 === $userIndex) {
                    $progress->setState(State::UNLOCKED);
                    $progress->setProgress($badge['target']);
                } else {
                    $progress->setState(State::LOCKED);
                    $progress->setProgress(0);

                }
                $manager->persist($progress);
            }
        }
        $manager->flush();

    }

}