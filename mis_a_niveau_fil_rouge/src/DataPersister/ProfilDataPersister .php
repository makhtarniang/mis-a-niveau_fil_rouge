<?php
namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Profil;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProfilDataPersister implements DataPersisterInterface
{
    private $userPasswordEncoder;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->entityManager = $entityManager;
    }

    public function supports($data): bool
    {
        return $data instanceof Profil;
    }
     /**
     * @param Profil $data
     */
    public function persist($data)
    {
       
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }

    public function remove($data)
    {
        $data->setStatut(true);
        $mareme= $data->getusers();
        foreach($mareme as $user){
            $user->setIsdeleted(true);
            $this->entityManager->persist($user);
            $this->entityManager->flush();

        }
        $this->entityManager->persist($data);
        $this->entityManager->flush();
        
    }
}