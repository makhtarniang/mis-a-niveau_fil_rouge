<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class profilFixtures extends Fixture
{
    public const USER_REFERENCE = 'user_profil';
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
                "type"=>"apprenant"
             ],
    ];
    
    $profils = new Profil();
    $profils->setLibelle("CM");
    $profils->setIsDeleted(false);

    $cm = new CM();

    $cm->setPrenom("CM");
    $cm->setNom("CM");
    $cm->setEmail("cm@gmail.com");
    $password = $this->encoder->encodePassword($cm, "cm");
    $cm->setPassword($password);
    $cm->setProfil($profils);
    $cm->setIsDeleted(false);
    $cm->setIslogging(false);
    $this->addReference(self::USER_REFERENCE, $cm);
    $manager->persist($profils);
    $manager->persist($cm);
    $manager->flush();
    }
}
