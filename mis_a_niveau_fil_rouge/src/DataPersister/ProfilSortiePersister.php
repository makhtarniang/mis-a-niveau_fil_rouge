<?php
namespace App\DataPersister;

use App\Entity\ProfilSortie;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;

class ProfilSortiePersister implements DataPersisterInterface
{
    private $manager;
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager= $manager; 
    }
    public function supports($data): bool
    {
        return $data instanceof ProfilSortie;
    }
    public function persist($data)
    {
       // $this->manager->persist($data);
        $this->manager->flush();
      return $data;
    }
    public function remove($data)
    {
       $data->setIsdeleted(true);
       $this->manager->flush();
    }
}