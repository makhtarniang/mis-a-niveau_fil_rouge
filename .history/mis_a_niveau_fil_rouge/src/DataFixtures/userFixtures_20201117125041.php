<?php

namespace App\DataFixtures;
use App\Entity\User;
use App\Entity\Profil;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class userFixtures extends Fixture
{
    $tab = ['ADMIN', "APPRENANT","FORMATEUR", "CM"];

    $tabUser = [
        [
            "prenom"=>'admin',
            'nom'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>'admin',
            'type'=>'admin'
        ],
        [
            "prenom"=>'cm',
            'nom'=>'cm',
            'email'=>'cm@gmail.com',
            'password'=>'cm',
            'type'=>'cm',
        ],
        [
            "prenom"=>'formateur',
            'nom'=>'formateur',
            'email'=>'formateur@gmail.com',
            'password'=>'formateur',
            'type'=>'formateur'
        ],
        [
            "prenom"=>'cm',
            'nom'=>'cm',
            'email'=>'cm@gmail.com',
            'password'=>'cm',
            'type'=>'cm'
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

        $manager->persist($profils);
        $manager->persist($cm);
        $manager->flush();
mm}
}