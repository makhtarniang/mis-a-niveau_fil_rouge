<?php

namespace App\DataFixtures;
use App\Entity\Tag;
use App\Entity\Competance;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TagFixtures extends Fixture 
{
    
  
    public function load(ObjectManager $manager)
    {
        
     $tag= new Tag();
             $tag->setLibelle('TP1');
             $tag->setDescriptif('Algo');
             $tag->setIsDeleted(false);
             $manager->persist($tag);
             $manager->flush();
}



}