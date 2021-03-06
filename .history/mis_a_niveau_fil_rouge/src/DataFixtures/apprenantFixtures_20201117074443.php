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
        $apprenant->setPrenom("admin");
        $apprenant->setNom("admin");
        $apprenant->setEmail("admin@gmail.com");
        $apprenant->setProfil($user);
        $apprenant->setIsDeleted(false);
        $apprenant->setIslogging(false);
        $this->addReference(self::USER_REFERENCE, $user);
        $manager->persist($apprenant);
        $manager->flush();
    }
}
