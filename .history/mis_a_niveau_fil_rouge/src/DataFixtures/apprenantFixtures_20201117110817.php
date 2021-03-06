<?php

namespace App\DataFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Apprenant;

class apprenantFixtures extends Fixture
{
    public const USER_REFERENCE = 'apprenant_user';
    public function load(ObjectManager $manager)
    {
        $apprenant = new Apprenant();
        $apprenant->setPrenom("apprenant");
        $apprenant->setNom("apprenant");
        $apprenant->setEmail("apprena@gmail.com");
      //  $apprenant->setProfil($apprenant);
        $apprenant->setIsDeleted(false);
        $apprenant->setIslogging(false);
        $this->addReference(self::USER_REFERENCE, $apprenant);
        $manager->persist($apprenant);
        $manager->flush();
    }
}
