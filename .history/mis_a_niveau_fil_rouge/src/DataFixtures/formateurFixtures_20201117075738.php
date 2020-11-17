<?php

namespace App\DataFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Formateur;

class formateurFixtures extends Fixture
{
    public const USER_REFERENCE = 'formateur_user';
    public function load(ObjectManager $manager)
    {
        $formateur = new Formateur();
        $formateur->setPrenom("fomateur");
        $formateur->setNom("formateur");
        $formateur->setEmail("formateur@gmail.com");
       // $user->setProfil($user);
        $formateur->setIsDeleted(false);
        $user->setIslogging(false);
        $this->addReference(self::USER_REFERENCE, $user);
        $manager->persist($user);
        $manager->flush();
    }
}
