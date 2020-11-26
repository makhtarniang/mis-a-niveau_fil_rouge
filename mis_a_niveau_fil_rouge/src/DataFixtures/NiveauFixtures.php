<?php

namespace App\DataFixtures;
use App\Entity\Tag;
use App\Entity\Niveau;
use App\Entity\GroupeTag;
use App\Entity\Competance;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class NiveauFixtures extends Fixture 
{
    
    public function load(ObjectManager $manager)
    {
        
     $niveau= new Niveau ();
             $niveau->setLibelle('niveau1');
             $niveau->setCritereEvaluation('C1');
             $niveau->setGroupeAction('G.1');
             $niveau->setIsdeleted(false);
             $manager->persist($niveau);
             $manager->flush();
}
}