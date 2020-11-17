<?php

namespace App\DataFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\CM;

class CMFixtures extends Fixture
{
    public const USER_REFERENCE = 'cm_user';
    public function load(ObjectManager $manager)
    {
        $cm = new CM();
        $apprenant->setPrenom("admin");
        $apprenant->setNom("admin");
        $apprenant->setEmail("admin@gmail.com");
      //  $apprenant->setProfil($apprenant);
        $apprenant->setIsDeleted(false);
        $apprenant->setIslogging(false);
        $this->addReference(self::USER_REFERENCE, $apprenant);
        $manager->persist($apprenant);
        $manager->flush();
    }
}
