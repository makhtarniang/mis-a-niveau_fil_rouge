<?php

namespace App\DataFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Profil;

class profilFixtures extends Fixture
{
    public const PROFIL_F ='formateur';
    public const PROFIL_APP ='apprenant';
    public const PROFIL_CM ='cm';
    public const PROFIL_AD ='admin';
    public function load(ObjectManager $manager)
    {
        $profilFormateur= new Profil();
        $profilFormateur->setLibelle('Formateur');
        $profilFormateur->setIsDeleted(false);
            $this->addReference(self::PROFIL_F,$profilFormateur);
            $manager->persist($profilFormateur);

             $profilCm= new Profil();
             $profilCm->setLibelle('Cm');
             $profilCm->setIsDeleted(false);
            $this->addReference(self::PROFIL_CM,$profilCm);
            $manager->persist($profilCm);

             $profilAd= new Profil();
             $profilAd->setLibelle('Admin');
             $profilAd->setIsDeleted(false);
             $this->addReference(self::PROFIL_AD,$profilAd);
             $manager->persist($profilAd);

             $profilApprenant= new Profil();
             $profilApprenant->setLibelle('Apprenant');
             $this->addReference(self::PROFIL_APP,$profilApprenant);
             $manager->persist($profilApprenant);

             $manager->flush();

}
}