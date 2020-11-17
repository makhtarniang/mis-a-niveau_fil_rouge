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

        $user = new User();
        $user->setPrenom("ADMIN");
        $user->setNom("admin");
        $user->setEmail("admin@gmail.com");
        $user->setIsDeleted(false);
        $user->setIslogging
        $this->addReference(self::USER_REFERENCE, $user);
        
        $manager->persist($user);
        $manager->flush();
    }
}
