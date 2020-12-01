<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FormateurRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=FormateurRepository::class)
 */
class Formateur extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity=Promo::class, inversedBy="formateurs")
     */
    private $Promo;

    public function __construct()
    {
        $this->Promo = new ArrayCollection();
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
}
