<?php

namespace App\DataFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class userFixtures extends Fixture
{
    public const USER_REFERENCE = 'admin_user';
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
     /*   $t1 = ["ADMIN"];
        $user = new User();
        $user->setPrenom("admin");
        $user->setNom("admin");
        $user->setEmail("admin@gmail.com");
        $user->setProfil($user);
        $user->setIsDeleted(false);
        $user->setIslogging(false);
        $this->addReference(self::USER_REFERENCE, $user);
        
        $manager->persist($user);
        $manager->flush();
    }
}
