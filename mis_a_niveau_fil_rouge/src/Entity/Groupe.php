<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GroupeRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=GroupeRepository::class)
 **
 * @ApiResource(
 *     denormalizationContext={"groups"={"groupe_write"}},
 *     collectionOperations={
 *       "get"={
 *          "path" = "admin/groupes",
 *          "normalization_context"={"groups":"groupe:read"},
 *     },
 *     "get"={
 *          "path"="admin/groupes/apprenants",
 *          "method"="GET",
 *          "normalization_context"={"groups":"groupeapprenant:read"},
 *     },
 *     "postapprenantformateur"={
 *          "path"="admin/groupes",
 *          "method"="POST",
 *     }
 *     },
 *     itemOperations={
 *       "get"={
 *          "path"="admin/groupes/{id}",
 *          "normalization_context"={"groups":"groupe:read"},
 *     },
 *     "put"={
 *          "path"="admin/groupes/{id}/apprenants",
 *          "method"="PUT",
 *     },
 *     "deletegroupeapprenant"={
 *          "path"="admin/groupes/{id}/apprenants",
 *          "method"="DELETE",
 *
 *     }
 *     }
 * )
 */
class Groupe
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
    private $nom;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Promo::class, inversedBy="groupe")
     */
    private $Promo;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isdeleted;

    /** 
     * @ORM\ManyToMany(targetEntity=Apprenant::class, inversedBy="Groupe")
     */


    private $apprenants;
    
    public function __construct()
    {
        $this->groupes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPromo(): ?self
    {
        return $this->Promo;
    }

    public function setPromo(?self $Promo): self
    {
        $this->Promo = $Promo;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(self $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
            $groupe->setPromo($this);
        }

        return $this;
    }
   /**
     * @return Collection|Formateur[]
     */
    public function getFormateur(): Collection
    {
        return $this->formateur;
    }

    public function addFormateur(Formateur $formateur): self
    {
        if (!$this->formateur->contains($formateur)) {
            $this->formateur[] = $formateur;
        }

        return $this;
    }

    public function removeGroupe(self $groupe): self
    {
        if ($this->groupes->removeElement($groupe)) {
            // set the owning side to null (unless already changed)
            if ($groupe->getPromo() === $this) {
                $groupe->setPromo(null);
            }
        }

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

    
}
