<?php

namespace App\Entity;

use App\Repository\GroupeCometanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupeCometanceRepository::class)
 */
class GroupeCometance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isdeleted;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descriptif;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeCometance::class, inversedBy="groupeCometances")
     */
    private $Competance;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeCometance::class, mappedBy="Competance")
     */
    private $groupeCometances;

    public function __construct()
    {
        $this->Competance = new ArrayCollection();
        $this->groupeCometances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getIsdeleted(): ?bool
    {
        return $this->isdeleted;
    }

    public function setIsdeleted(bool $isdeleted): self
    {
        $this->isdeleted = $isdeleted;

        return $this;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): self
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getCompetance(): Collection
    {
        return $this->Competance;
    }

    public function addCompetance(self $competance): self
    {
        if (!$this->Competance->contains($competance)) {
            $this->Competance[] = $competance;
        }

        return $this;
    }

    public function removeCompetance(self $competance): self
    {
        $this->Competance->removeElement($competance);

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getGroupeCometances(): Collection
    {
        return $this->groupeCometances;
    }

    public function addGroupeCometance(self $groupeCometance): self
    {
        if (!$this->groupeCometances->contains($groupeCometance)) {
            $this->groupeCometances[] = $groupeCometance;
            $groupeCometance->addCompetance($this);
        }

        return $this;
    }

    public function removeGroupeCometance(self $groupeCometance): self
    {
        if ($this->groupeCometances->removeElement($groupeCometance)) {
            $groupeCometance->removeCompetance($this);
        }

        return $this;
    }
}
