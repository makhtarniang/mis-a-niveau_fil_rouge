<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FormateurRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=FormateurRepository::class)
 * @ApiResource()
 */
class Formateur extends User
{
    /**
     * @ORM\ManyToMany(targetEntity=Promo::class, inversedBy="formateurs")
     */
    private $Promo;

    /**
     * @ORM\ManyToMany(targetEntity=Formateur::class, inversedBy="formateurs")
     */
    private $Groupe;

    public function __construct()
    {
        $this->Promo = new ArrayCollection();
        $this->Groupe = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Promo[]
     */
    public function getPromo(): Collection
    {
        return $this->Promo;
    }

    public function addPromo(Promo $promo): self
    {
        if (!$this->Promo->contains($promo)) {
            $this->Promo[] = $promo;
        }

        return $this;
    }

    public function removePromo(Promo $promo): self
    {
        $this->Promo->removeElement($promo);

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getGroupe(): Collection
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

    
}
