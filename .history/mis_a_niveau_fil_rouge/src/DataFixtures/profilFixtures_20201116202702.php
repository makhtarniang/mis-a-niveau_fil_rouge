<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class profilFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
$t2 =["CM","FORMATEUR","APPRENANT"];
    $tabProfil =[
             [
                "prenom"=>"cm",
                "nom"=>"cm",
                "email"=>"cm@gmail.com",
                "password"=>"cm",
                "type"=>"cm"
             ],
             [
                "prenom"=>"formateur",
                "nom"=>"formateur",
                "email"=>"formateur@gmail.com",
                "password"=>"formateur",
                "type"=>"formateur"
             ],
             [
                "prenom"=>"apprenant",
                "nom"=>"apprenant",
                "email"=>"apprenant@gmail.com",
                "password"=>"apprenant",
                "type"=>""
             ],
    ];
        $manager->flush();
    }
}
