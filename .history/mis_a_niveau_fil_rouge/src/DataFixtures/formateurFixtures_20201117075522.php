<?php

namespace App\DataFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\User;

class userFixtures extends Fixture
{
    public const USER_REFERENCE = 'admin_user';
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setPrenom("admin");
        $user->setNom("admin");
        $user->setEmail("admin@gmail.com");
       // $user->setProfil($user);
        $user->setIsDeleted(false);
        $user->setIslogging(false);
        $this->addReference(self::USER_REFERENCE, $user);
        $manager->persist($user);
        $manager->flush();
    }
}
