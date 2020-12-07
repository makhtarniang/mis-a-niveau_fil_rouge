<?php

namespace App\Entity;

use App\Entity\Promo;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GroupeRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=GroupeRepository::class)
 *
 * @ApiResource(
 *     attributes={  
 *          "security"="is_granted('ROLE_Admin') or is_granted('ROLE_Cm')",
 *          "security_message"="Impossible de l'acces" ,
 *         "denormalization_context"={"groups"={"groupe_write"},"enable_max_depth="=true} ,
 *        "normalizationContext"={"groups"={"groupe_read"}}
 *      },
 *  collectionOperations={
 *       "get"={
 *          "path"="admin/groupes",    
 *     },
 *     "get"={
 *          "path"="admin/groupes/apprenants",  
 *     },
 *     "post"={
 *          "path"="admin/groupes",
 *          "denormalization_context"={"groups"={"groupe_write"}}
 *     }
 *     },
 *     itemOperations={
 *       "get"={
 *          "path"="admin/groupes/{id}",
 *     },
 *     "put"={
 *          "path"="admin/groupes/{id}/apprenants",
 *          "method"="PUT",
 *     },
 *  "delete"={
 *          "path"="admin/groupes/{id}/apprenants",
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
     * @Groups({"groupe_write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"groupe_write"})
     * @Groups({"groupe_read"})
     */
    private $nom;

    /**
     * @ORM\Column(type="date")
     * @Groups({"groupe_write"})
     * @Groups({"groupe_read"})
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"groupe_write"})
     * @Groups({"groupe_read"})
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"groupe_write"})
     * @Groups({"groupe_read"})
     */
    private $type;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isdeleted;

    /**
     * @ORM\ManyToOne(targetEntity=Promo::class, inversedBy="groupe")
     * @Groups({"groupe_write"})
     */
    private $Promo;

    /** 
     * @ORM\ManyToMany(targetEntity=Apprenant::class, inversedBy="Groupe")
     * @Groups({"groupe_write"})
     * @Groups({"groupe_read"})
     */
    private $apprenants;

    /**
     * @ORM\ManyToMany(targetEntity=Formateur::class, inversedBy="groupes")
     * @Groups({"groupe_write"})
     * @Groups({"groupe_read"})
     */
    
    private $formateur;
    
    public function __construct()
    {
        $this->groupes = new ArrayCollection();
        $this->formateur = new ArrayCollection();
        $this->apprenant = new ArrayCollection();
        $this->setIsdeleted(false);
        $this->setDateCreation(new \DateTime());
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

    public function getPromo(): ?Promo
    {
        return $this->Promo;
    }

    public function setPromo(?self $Promo): self
    {
        $this->Promo = $Promo;

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

    public function removeFormateur(Formateur $formateur): self
    {
        $this->Formateur->removeElement($formateur);

        return $this;
    }

    
}
