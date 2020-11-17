<?php

namespace App\DataFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class apprenantFixtures extends Fixture
{
    public const USER_REFERENCE = 'apprenant_user';
    public function load(ObjectManager $manager)
    {
        $user = new APPRENANT();
        $user->setPrenom("admin");
        $user->setNom("admin");
        $user->setEmail("admin@gmail.com");
        $user->setProfil($user);
        $user->setIsDeleted(false);
        $apprenant->setIslogging(false);
        $this->addReference(self::USER_REFERENCE, $user);
        $manager->persist($apprenant);
        $manager->flush();
    }
}
