<?php

namespace App\DataFixtures;
use App\Entity\CM;
use App\Entity\User;
use App\Entity\Profil;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/*class userFixtures extends Fixture
{
   public const PROFIL_F ='formateur';
    public const PROFIL_APP ='apprenant';
    public const PROFIL_CM ='cm';
    public const PROFIL_AD ='admin';
    public function load(ObjectManager $manager)
    {
      
            $profilFor= new Profil();
            $profilFor->setLibelle('Formateur');
                $this->addReference(self::PROFIL_F,$profilFor);
                $manager->persist($profilFor);
    
                $profilCm= new Profil();
                $profilCm->setLibelle('Cm');
                $this->addReference(self::PROFIL_CM,$profilCm);
                $manager->persist($profilCm);
    
                $profilAd= new Profil();
                $profilAd->setLibelle('Administrateur');
                $this->addReference(self::PROFIL_AD,$profilAd);
                $manager->persist($profilAd);
    
                 $profilApp= new Profil();
                 $profilApp->setLibelle('Apprenant');
                 $this->addReference(self::PROFIL_APP,$profilApp);
                 $manager->persist($profilApp);
    
                $manager->flush();
        
}


}*/

class AppFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {


        $tab = ['ADMIN', "APPRENANT","FORMATEUR", "CM"];

        $tabUser = [
            [
                "prenom"=>'admin',
                'nom'=>'admin',
                'email'=>'admin@gmail.com',
                'password'=>'admin',
                'type'=>'admin'
            ],
            [
                "prenom"=>'cm',
                'nom'=>'cm',
                'email'=>'cm@gmail.com',
                'password'=>'cm',
                'type'=>'cm',
            ],
            [
                "prenom"=>'formateur',
                'nom'=>'formateur',
                'email'=>'formateur@gmail.com',
                'password'=>'formateur',
                'type'=>'formateur'
            ],
            [
                "prenom"=>'cm',
                'nom'=>'cm',
                'email'=>'cm@gmail.com',
                'password'=>'cm',
                'type'=>'cm'
            ],
        ];

            $profils = new Profil();
            $profils->setLibelle("CM");
            $profils->setIsDeleted(false);

            $cm = new CM();

            $cm->setPrenom("CM");
            $cm->setNom("CM");
            $cm->setEmail("cm@gmail.com");
           // $password = $this->encoder->encodePassword($cm, "cm");
            $cm->setPassword($password);
            $cm->setProfil($profils);
            $cm->setIsDeleted(false);
            $cm->setIslogging(false);

            $manager->persist($profils);
            $manager->persist($cm);
            $manager->flush();

        }
}
