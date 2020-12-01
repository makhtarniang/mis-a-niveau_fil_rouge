<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReferencielRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=ReferencielRepository::class)
 * @ApiResource()
 */
class Referenciel
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
     * @ORM\Column(type="text")
     */
    private $presentation;

    /**
     * @ORM\Column(type="blob")
     */
    private $programme;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $critairEvaluation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $criterAdmission;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isdeleted;

    /**
     * @ORM\OneToMany(targetEntity=Promo::class, mappedBy="referenciel")
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

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getProgramme()
    {
        return $this->programme;
    }

    public function setProgramme($programme): self
    {
        $this->programme = $programme;

        return $this;
    }

    public function getCritairEvaluation(): ?string
    {
        return $this->critairEvaluation;
    }

    public function setCritairEvaluation(string $critairEvaluation): self
    {
        $this->critairEvaluation = $critairEvaluation;

        return $this;
    }

    public function getCriterAdmission(): ?string
    {
        return $this->criterAdmission;
    }

    public function setCriterAdmission(string $criterAdmission): self
    {
        $this->criterAdmission = $criterAdmission;

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

    public function getReferenciel(): ?self
    {
        return $this->referenciel;
    }

    public function setReferenciel(?self $referenciel): self
    {
        $this->referenciel = $referenciel;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getPromo(): Collection
    {
        return $this->Promo;
    }

    public function addPromo(self $promo): self
    {
        if (!$this->Promo->contains($promo)) {
            $this->Promo[] = $promo;
            $promo->setReferenciel($this);
        }

        return $this;
    }

    public function removePromo(self $promo): self
    {
        if ($this->Promo->removeElement($promo)) {
            // set the owning side to null (unless already changed)
            if ($promo->getReferenciel() === $this) {
                $promo->setReferenciel(null);
            }
        }

        return $this;
    }
}
