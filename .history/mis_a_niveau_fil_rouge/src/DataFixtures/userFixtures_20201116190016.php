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
            ],
        ];
        $profils = new Profil();
        $profils->setLibelle("ADMIN");
        $profils->setIsDeleted(false);

        $cm = new ADMIN();

        $admin->setPrenom("ADMIN");
        $admin->setNom("ADMIN");
        $cm->setEmail("admin@gmail.com");
        $password = $this->encoder->encodePassword($cm, "admin");
        $cm->setPassword($password);
        $cm->setProfil($profils);
        $cm->setIsDeleted(false);
        $cm->setIslogging(false);

        $manager->persist($profils);
        $manager->persist($cm);
        $manager->flush();
    }
}
