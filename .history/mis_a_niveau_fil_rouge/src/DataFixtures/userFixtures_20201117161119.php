<?php

namespace App\DataFixtures;
use App\Entity\User;
use App\Entity\Profil;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class userFixtures extends Fixture
{
    public $crypt;
    public function __construct(UserPasswordEncoderInterface $crypt)
    {
        $this->crypt=$crypt;
    }
  
    public function load(ObjectManager $manager)
    {
      
           $a= new User();
           $a->setNom('admin')
           ->setPrenom('admin')
           ->setEmail('email@gmail.com')
           ->setPassword($this->crypt->encodePassword($a,'admin'));
           $manager->persist($admin);
              
    
                $manager->flush();
        
}
}