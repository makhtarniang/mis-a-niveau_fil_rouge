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
         
      /*  $t1 = ["FORMATEUR","CM","APPRENANT","ADMIN"];
        $tUser = [
            [
                "prenom"=>'admin',
                'nom'=>'admin',
                'email'=>'admin@gmail.com',
                'password'=>'admin',
                'type'=>'admin'
            ],
        ];
        $profils = new Profil();
        $profils->setLibelle("ADMIN");
        $profils->setIsDeleted(false);
        $admin = new ADMIN();
        $admin->setPrenom("ADMIN");
        $admin->setNom("ADMIN");
        $admin->setEmail("admin@gmail.com");
        $password = $this->encoder->encodePassword($admin, "admin");
        $admin->setPassword($password);
        $admin->setProfil($profils);
        $admin->setIsDeleted(false);
        $admin->setIslogging(false);

        $manager->persist($profils);
        $manager->persist($admin);*/

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


        $manager->flush();
    }
}
