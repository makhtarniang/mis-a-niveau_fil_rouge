<?php

namespace App\DataFixtures;
use App\Entity\User;
use App\Entity\Profil;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class userFixtures extends Fixture
{
    public $$crypt
  
    public function load(ObjectManager $manager)
    {
      
            $admin= new User();
           $admin->setNom('test')
           ->setPrenom('testPrenom')
           ->setEmail('email@gmail.com')
           ->setPassword()
    
              
    
                $manager->flush();
        
}
}