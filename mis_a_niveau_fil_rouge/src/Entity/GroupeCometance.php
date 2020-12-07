<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GroupeCometanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=GroupeCometanceRepository::class)"defaults"={"id"=null}
 * @ApiResource(
 * attributes={
 *          "security"="(is_granted('ROLE_Admin'))",
 *          "security_message"="impossible de l'acces",
 *      },
 *      normalizationContext={"groups"={"grpcompetance_read"}},
 * collectionOperations={
 *  "get"={
 *       "method"="GET",
 *       "path"="admin/grpecompetences",
 *       "defaults"={"id"=null}
 *     },
 * "post"={
 *          "path"="admin/grpecompetences",
 *          "method"="POST",
 *       }
 *     },
 * itemOperations={
 *         "get"={
 *              "path"="admin/grpecompetences/{id}",      
 *         },
 *     "putgrp"={
 *        "path"="admin/competences/{id}",
 *      "method"="PUT",
 *       "normalization_context"={"groups"={"grpcompetance_read"}},
 *     }
 *     }
 * )
 * )
 */
class GroupeCometance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"referentiel_read"})
     * @Groups({"referanciel_write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"referentiel_read"})
     * @Groups({"referanciel_write"})
     * @Assert\NotBlank(
     *     message="Champ libelle est vide"
     * )
     */
    private $libelle;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isdeleted;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"referenciel_read"})
     * @Groups({"referanciel_write"})
     */
    private $descriptif;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeCometance::class, inversedBy="groupeCometances")
     * @Groups({"grpcompetance_read"})
     */
    private $Competance;

    /**
     * @ORM\ManyToMany(targetEntity=Referenciel::class, inversedBy="groupeCometances")
     * @ORM\JoinColumn(nullable=true)
     */
    private $Referenciel;

    public function __construct()
    {
        $this->Competance = new ArrayCollection();
        $this->Referenciel = new ArrayCollection();
        $this->setIsdeleted(false);
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
     * @return Collection|Referenciel[]
     */
    public function getReferenciel(): Collection
    {
        return $this->Referenciel;
    }

    public function addReferenciel(Referenciel $referenciel): self
    {
        if (!$this->Referenciel->contains($referenciel)) {
            $this->Referenciel[] = $referenciel;
        }

        return $this;
    }

    public function removeReferenciel(Referenciel $referenciel): self
    {
        $this->Referenciel->removeElement($referenciel);

        return $this;
    }

    
}
