<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ApprenantRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ApprenantRepository::class)
 * @ApiResource()
 */
class Apprenant extends User
{

    /**
     * @ORM\ManyToMany(targetEntity=Groupe::class, mappedBy="apprenants")
     */
    private $Groupe;

    

    /**
     * @ORM\ManyToOne(targetEntity=ProfilSortie::class, inversedBy ="apprenant")
     */
    private $ProfilSortie;

   


    public function __construct()
    {
        $this->Groupe = new ArrayCollection();
       
        $this->ProfilSortie = new ArrayCollection();
      
    }

    public function getId(): ?int
    {
        return $this->id;
    }

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

    public function getApprenant(): ?self
    {
        return $this->apprenant;
    }

    public function setApprenant(?self $apprenant): self
    {
        $this->apprenant = $apprenant;

        return $this;
    }

    /**
     * @return Collection|ProfilSortie[]
     */
    public function getProfilSortie(): Collection
    {
        return $this->ProfilSortie;
    }

    public function addProfilSortie(ProfilSortie $profilSortie): self
    {
        if (!$this->ProfilSortie->contains($profilSortie)) {
            $this->ProfilSortie[] = $profilSortie;
            $profilSortie->setApprenant($this);
        }

        return $this;
    }

    public function removeProfilSortie(ProfilSortie $profilSortie): self
    {
        if ($this->ProfilSortie->removeElement($profilSortie)) {
            // set the owning side to null (unless already changed)
            if ($profilSortie->getApprenant() === $this) {
                $profilSortie->setApprenant(null);
            }
        }

        return $this;
    }

   

}
