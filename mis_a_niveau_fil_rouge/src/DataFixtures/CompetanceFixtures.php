<?php

namespace App\DataFixtures;
use App\Entity\Competance;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CompetanceFixtures extends Fixture 
{
    
  
    public function load(ObjectManager $manager)
    {
        
     $compet= new Competance();
             $compet->setLibelle('Informatique');
             $compet->setDescriptif('Développeur applicatif');
             $compet->setIsDeleted(false);
             $manager->persist($compet);
             $manager->flush();
}



}