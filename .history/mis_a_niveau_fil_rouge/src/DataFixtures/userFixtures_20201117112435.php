<?php

namespace App\DataFixtures;
use App\Entity\User;
use Lcobucci\JWT\Claim\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class userFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    $faker= Factory::create('en_EN');
    $formateur= new  User();
    $formateur->setNom($faker->nom)
            ->setPrenom($faker->prenom)
            ->setEmail($faker->email)
            ->setPassword($this->encoder->encodePassword($formateur,'password'))
            ->setType($faker->type)
            ->setProfil($this->getReference(ProfilFixtures::PROFIL_F));
         $manager->persist($formateur);
        $manager->flush();
    }
}
