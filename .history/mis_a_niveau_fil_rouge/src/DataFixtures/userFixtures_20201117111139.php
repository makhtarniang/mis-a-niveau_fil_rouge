<?php

namespace App\DataFixtures;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class userFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    $formateur= new  User();
    $formateur->setNom($faker->firstName)
            ->setPrenom($faker->lastName)
            ->setEmail($faker->email)
            ->setPassword($this->encoder->encodePassword($formateur,'password'))
            ->setislogging($faker->address)
            ->set(A)
            ->setProfil($this->getReference(ProfilFixtures::PROFIL_F));
         $manager->persist($formateur);
        $manager->flush();
    }
}
