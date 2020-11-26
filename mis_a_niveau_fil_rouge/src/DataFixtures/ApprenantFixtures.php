<?php

namespace App\DataFixtures;
use App\Entity\User;
use App\Entity\Profil;
use App\Entity\Apprenant;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ApprenantFixtures extends Fixture implements DependentFixtureInterface
{
    public $crypt;
    public function __construct(UserPasswordEncoderInterface $crypt)
    {
        $this->crypt=$crypt;
    }
  
    public function load(ObjectManager $manager)
    {
        
       $profilApp= new Apprenant();
             $profilApp->setEmail('apprenant@gmail.com');
             $profilApp->setNom('niang');
             $profilApp->setPrenom('makhtar');
             $profilApp->setPassword($this->crypt->encodePassword($profilApp,'password'));
             $profilApp->setProfil($this->getReference(ProfilFixtures::PROFIL_APP));
             $manager->persist($profilApp);
             
             $manager->flush();
}

public function getDependencies()
    {
        return array(
            ProfilFixtures::class,
        );
    }

}