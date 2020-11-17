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
      
            $admin= new Use();
            $profilFor->setLibelle('Formateur');
                $this->addReference(self::PROFIL_F,$profilFor);
                $manager->persist($profilFor);
    
              
    
                $manager->flush();
        
}
}