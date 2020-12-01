<?php

namespace App\DataFixtures;
use App\Entity\Groupe;
use App\Entity\Apprenant;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class GroupeFixtures extends Fixture 
{
    
  
    public function load(ObjectManager $manager)
    {
        
       $groupe= new Groupe();
             $groupe->setNom('niang');
            $groupe->setDateCreation('12/04/2021');
             $groupe->setNom('niang');
             $groupe->setStatut(true);
             $groupe->setType('Prencipale');
            $groupe->setPromo('P3');
             $manager->persist($groupe);
             $manager->flush();
}

}