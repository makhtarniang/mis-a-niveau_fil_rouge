<?php

namespace App\DataFixtures;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class userFixtures extends Fixture
{
    $formateur= new  User();
    $formateur->setFirstname($faker->firstName)
            ->setLastname($faker->lastName)
            ->setEmail($faker->email)
            ->setPassword($this->encoder->encodePassword($formateur,'password'))
            ->setAddress($faker->address)
            ->setR(770912122)
            ->setProfil($this->getReference(ProfilFixtures::PROFIL_F));
         $manager->persist($formateur);
        $manager->flush();
    }
}
