<?php

namespace App\DataFixtures;
use App\Entity\CM;
use App\Entity\User;
use App\Entity\Profil;
use App\Entity\Apprenant;
use App\DataFixtures\ProfilFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CmFixtures extends Fixture implements DependentFixtureInterface
{
    public $crypt;
    public function __construct(UserPasswordEncoderInterface $crypt)
    {
        $this->crypt=$crypt;
    }
  
    public function load(ObjectManager $manager)
    {
        
       $profilCm= new CM();
             $profilCm->setEmail('cm@gmail.com');
             $profilCm->setNom('cm');
             $profilCm->setPrenom('cm');
             $profilCm->setPassword($this->crypt->encodePassword($profilCm,'password'));
             $profilCm->setProfil($this->getReference(ProfilFixtures::PROFIL_APP));
             $manager->persist($profilCm);
             
             $manager->flush();
}
public function getDependencies()
    {
        return array(
            ProfilFixtures::class,
        );
    }

}