<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ApprenantRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=ApprenantRepository::class)
 * @ApiResource()
 */
class Apprenant extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity=Groupe::class, mappedBy="apprenants")
     */
    private $Groupe;


    public function __construct()
    {
        $this->Groupe = new ArrayCollection();
        $this->apprenants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|self[]
     */
   /* public function getGroupe(): Collection
    {
        return $this->Groupe;
    }

    public function addGroupe(self $groupe): self
    {
        if (!$this->Groupe->contains($groupe)) {
            $this->Groupe[] = $groupe;
        }

        return $this;
    }

    public function removeGroupe(self $groupe): self
    {
        $this->Groupe->removeElement($groupe);

        return $this;
    }
*/
    /**
     * @return Collection|self[]
     */
    public function getApprenants(): Collection
    {
        return $this->apprenants;
    }

    public function addApprenant(self $apprenant): self
    {
        if (!$this->apprenants->contains($apprenant)) {
            $this->apprenants[] = $apprenant;
            $apprenant->addGroupe($this);
        }

        return $this;
    }

    public function removeApprenant(self $apprenant): self
    {
        if ($this->apprenants->removeElement($apprenant)) {
            $apprenant->removeGroupe($this);
        }

        return $this;
    }
}
