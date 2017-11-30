<?php
namespace AppBundle\DataFixtures;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setEmail("mosterfication_{$i}@getresponse.com");
            $user->setUserName("username_{$i}");
            $user->setNickname("nickname_{$i}");
            $user->setRole(0);

            $manager->persist($user);
        }

        $manager->flush();
    }
}