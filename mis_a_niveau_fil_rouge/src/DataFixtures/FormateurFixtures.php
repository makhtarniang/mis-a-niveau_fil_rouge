<?php

namespace App\DataFixtures;
use App\Entity\User;
use App\Entity\Profil;
use App\Entity\Formateur;
use App\DataFixtures\ProfilFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class FormateurFixtures extends Fixture implements DependentFixtureInterface
{
    public $crypt;
    public function __construct(UserPasswordEncoderInterface $crypt)
    {
        $this->crypt=$crypt;
    }
  
    public function load(ObjectManager $manager)
    {
        
       $profilFor= new Formateur();
             $profilFor->setEmail('formateur@gmail.com');
             $profilFor->setNom('niang');
             $profilFor->setPrenom('aly');
             $profilFor->setPassword($this->crypt->encodePassword($profilFor,'password'));
             $profilFor->setIsdeleted(false);
             $profilFor->setProfil($this->getReference(ProfilFixtures::PROFIL_F));
             $manager->persist($profilFor);
             
             $manager->flush();
}
public function getDependencies()
    {
        return array(
            ProfilFixtures::class,
        );
    }

}