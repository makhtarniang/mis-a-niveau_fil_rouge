<?php

namespace App\DataFixtures;
use App\Entity\Tag;
use App\Entity\GroupeTag;
use App\Entity\Competance;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GroupeTagFixtures extends Fixture 
{
    
    public function load(ObjectManager $manager)
    {
        
     $Gt= new GroupeTag ();
             $Gt->setLibelle('G1.2');
             $Gt->setIsDeleted(false);
             $manager->persist($Gt);
             $manager->flush();
}
}