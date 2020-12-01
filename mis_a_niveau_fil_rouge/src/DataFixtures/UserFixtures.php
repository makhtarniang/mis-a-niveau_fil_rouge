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

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public $crypt;
    public function __construct(UserPasswordEncoderInterface $crypt)
    {
        $this->crypt=$crypt;
    }
  
    public function load(ObjectManager $manager)
    {
        
       $profilUser= new User();
             $profilUser->setEmail('admin@gmail.com');
             $profilUser->setNom('admin');
             $profilUser->setPrenom('admin');
             $profilUser->setPassword($this->crypt->encodePassword($profilUser,'password'));
             $profilUser->setIsdeleted(false);
             $profilUser->setProfil($this->getReference(ProfilFixtures::PROFIL_F));
             $manager->persist($profilUser);
             
             $manager->flush();
}
public function getDependencies()
    {
        return array(
            ProfilFixtures::class,
        );
    }

}