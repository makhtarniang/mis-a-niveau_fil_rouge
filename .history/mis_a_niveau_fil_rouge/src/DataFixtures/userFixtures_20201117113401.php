<?php

namespace App\DataFixtures;
use App\Entity\User;
use App\Entity\Profil;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class userFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        public const PROFIL_F ='formateur';
        public const PROFIL_APP ='apprenant';
        public const PROFIL_CM ='cm';
        public const PROFIL_AD ='admin';
        public function load(ObjectManager $manager)
        {
            $profilFor= new Profil();
            $profilFor->setLibelle('Formateur');
                $this->addReference(self::PROFIL_F,$profilFor);
                $manager->persist($profilFor);
    
                 $profilCm= new Profil();
            $profilCm->setLibelle('Cm');
                $this->addReference(self::PROFIL_CM,$profilCm);
                $manager->persist($profilCm);
    
                $profilAd= new Profil();
                $profilAd->setLibelle('Administrateur');
                $this->addReference(self::PROFIL_AD,$profilAd);
                $manager->persist($profilAd);
    
                 $profilApp= new Profil();
                 $profilApp->setLibelle('Apprenant');
                 $this->addReference(self::PROFIL_APP,$profilApp);
                 $manager->persist($profilApp);
    
    
                $manager->flush();
        }
}
