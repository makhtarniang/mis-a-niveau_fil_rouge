<?php

namespace App\DataFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\User;

class userFixtures extends Fixture
{
    $formateur= new  Formateur();
    $formateur->setFirstname($faker->firstName)
            ->setLastname($faker->lastName)
            ->setEmail($faker->email)
            ->setPassword($this->encoder->encodePassword($formateur,'password'))
            ->setAddress($faker->address)
            ->setTel(770912122)
            ->setProfil($this->getReference(ProfilFixtures::PROFIL_F));
         $manager->persist($formateur);
        $manager->flush();
    }
}
