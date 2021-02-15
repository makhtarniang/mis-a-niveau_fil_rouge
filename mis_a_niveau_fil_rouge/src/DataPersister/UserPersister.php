<?php
namespace App\DataPersister;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;

class UserPersister implements DataPersisterInterface
{
    private $manager;
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager= $manager; 
    }
    public function supports($data): bool
    {
        return $data instanceof User;
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