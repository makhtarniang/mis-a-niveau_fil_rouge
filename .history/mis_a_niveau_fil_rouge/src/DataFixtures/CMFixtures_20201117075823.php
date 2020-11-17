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
        $cm->setPrenom("cm");
        $cm->setNom("cm");
        $cm->setEmail("admin@gmail.com");
      //  $apprenant->setProfil($apprenant);
        $cm->setIsDeleted(false);
        $cm->setIslogging(false);
        $this->addReference(self::USER_REFERENCE, $cm);
        $manager->persist($cm);
        $manager->flush();
    }
}
