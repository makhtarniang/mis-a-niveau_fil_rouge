<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class userFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
         
        $t1 = ["FORMATEUR","CM","APPRENANT","ADMIN"];
        $tabUser = [
            [
                "prenom"=>'admin',
                'nom'=>'admin',
                'email'=>'admin@gmail.com',
                'password'=>'admin',
                'type'=>'admin'
            ];
        ]

        $manager->flush();
    }
}
