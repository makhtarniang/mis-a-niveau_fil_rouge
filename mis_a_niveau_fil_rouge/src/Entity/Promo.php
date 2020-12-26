<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PromoRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PromoRepository::class)
 * @ApiResource(
 * 
 *  denormalizationContext={"groups"={"promo_write"}},
 *     collectionOperations={
 *          "getrefgroupe"={
 *              "method"="GET",
 *              "path"="admin/promo",
 *              "route_name"="listerefgroupe",
 *              "normalization_context"={"groups":"promo:read"},
 *     },
 *      "getgrpeprincipal"={
 *              "method"="GET",
 *              "path"="admin/promo/principal",
 *              "route_name"="listeprgeprincipal",
 *              "normalization_context"={"groups":"appreantgrpeprincipal:read"},
 *             
 *     },
 *     "getapprenantattente"={
 *          "method"="GET",
 *          "path"="admin/promo/apprenants/attente",
 *          "route_name"="listeapprenantattente",
 *          "normalization_context"={"groups":"appreantattente:read"},
 *         
 *     },
 *     "postpromo"={
 *          "path"="admin/promo",
 *          "method"="POST",
 *          "route_name"="createpromo",
 *     },
 *      },
 *     itemOperations={
 *      "get"={
 *          "path"="admin/promo/{id}",
 *          "normalization_context"={"groups":"promo:read"},
 *     },
 *     "getpromoprincipalbyid"={
 *          "path"="admin/promo/{id}/principal",
 *          "method"="GET",
 *          "route_name"="listpromoprincipalbyid",
 *          "normalization_context"={"groups":"appreantgrpeprincipal:read"},
 *         
 *     },
 *      "getpromoref"={
 *          "method"="GET",
 *          "path"="admin/promo/{id}/referentiels",
 *          "route_name"="listpromoref",
 *          "normalization_context"={"groups":"promo_referentiel:read"},
 *     },
 *     "getapprenantenattente"={
 *          "method"="GET",
 *          "path"="admin/promo/{id}/apprenants/attente",
 *          "route_name"="listapprenantenattente",
 *          "normalization_context"={"groups":"appreantattente:read"},
 *     },
 *
 *     "getpromoapprenant"={
 *          "path"="admin/promo/{id}/groupes/{groupe}/apprenants",
 *          "method"="GET",
 *          "route_name"="listepromogroupe",
 *          "normalization_context"={"groups":"promoandgroupe:read"},
 *     },
 *     "getpromoformateur"={
 *              "path"="api/admin/promo/{id}/formateurs",
 *              "method" = "GET",
 *              "route_name"="listpromoformateur",
 *              "normalization_context"={"groups":"promoformateur:read"},
 *             
 *     },
 *
 *   "getupdatepromoref"={
 *          "method"="PUT",
 *          "path"="admin/promo/{id}",
 *          "route_name"="upgradepromoref",
 *       
 *     },
 *   "getupdatepromoapprenant"={
 *          "method"="PUT",
 *          "path"="admin/promo/{id}/apprenants",
 *          "route_name"="upgradepromoapprenant",
 *        
 *     },
 *     "getupdatepromoformateurs"={
 *          "method"="PUT",
 *          "path"="admin/promo/{id}/formateurs",
 *          "route_name"="upgradepromoformateurs",
 *          
 *     },
 *     "updatepromogroupe"={
 *          "method"="PUT",
 *          "path"="admin/promo/{id}/groupes/{groupe}",
 *          "route_name"="updatepromogroupe",
 *         
 *     }
 *     })
 */
class Promo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"promo:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
    
     * @Groups({"groupe_read","promo:read"})
     */
    private $langue;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"groupe_read","promo:read"})
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"groupe_read","promo:read"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"groupe_read","promo:read"})
     */
    private $lieu;

    /**
     * @ORM\Column(type="date")
     * @Groups({"promo:read"})
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date")
     * 
     * @Groups({"groupe_read","promo:read"})
     */
    private $dateFinProvisiore;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"groupe_read","promo:read"})
     */
    private $fabrique;

    /**
     * @ORM\Column(type="date")
     * 
     * @Groups({"groupe_read","promo:read"})
     */
    private $dateFinReele;

    /**
     * @ORM\Column(type="boolean")
     * 
     * @Groups({"groupe_read","promo:read"})
     */
    private $etat;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"groupe_read","promo:read"})
     */
    private $referenceAgate;
    /**
     * @ORM\OneToMany(targetEntity=Groupe::class, mappedBy="Promo")
     */
    private $groupe;

    /**
     * @ORM\ManyToMany(targetEntity=Formateur::class, mappedBy="Promo")
     */
    private $formateurs;

    /**
     * @ORM\OneToMany(targetEntity=Referenciel::class, mappedBy="promo")
     */
    private $Referenciel;
  
    public function __construct()
    {
        $this->formateurs = new ArrayCollection();
        $this->Referenciel = new ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): self
    {
        $this->langue = $langue;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFinProvisiore(): ?\DateTimeInterface
    {
        return $this->dateFinProvisiore;
    }

    public function setDateFinProvisiore(\DateTimeInterface $dateFinProvisiore): self
    {
        $this->dateFinProvisiore = $dateFinProvisiore;

        return $this;
    }

    public function getFabrique(): ?string
    {
        return $this->fabrique;
    }

    public function setFabrique(string $fabrique): self
    {
        $this->fabrique = $fabrique;

        return $this;
    }

    public function getDateFinReele(): ?\DateTimeInterface
    {
        return $this->dateFinReele;
    }

    public function setDateFinReele(\DateTimeInterface $dateFinReele): self
    {
        $this->dateFinReele = $dateFinReele;

        return $this;
    }

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getReferenceAgate(): ?string
    {
        return $this->referenceAgate;
    }

    public function setReferenceAgate(string $referenceAgate): self
    {
        $this->referenceAgate = $referenceAgate;

        return $this;
    }
    /**
     * @return Collection|Groupe[]
     */
    public function getGroupe(): Collection
    {
        return $this->groupe;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupe->contains($groupe)) {
            $this->groupe[] = $groupe;
            $groupe->setPromo($this);
        }

        return $this;
    }

    /**
     * @return Collection|Formateur[]
     */
    public function getFormateurs(): Collection
    {
        return $this->formateurs;
    }

    public function addFormateur(Formateur $formateur): self
    {
        if (!$this->formateurs->contains($formateur)) {
            $this->formateurs[] = $formateur;
            $formateur->addPromo($this);
        }

        return $this;
    }

    public function removeFormateur(Formateur $formateur): self
    {
        if ($this->formateurs->removeElement($formateur)) {
            $formateur->removePromo($this);
        }

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
            $referenciel->setPromo($this);
        }

        return $this;
    }

    public function removeReferenciel(Referenciel $referenciel): self
    {
        if ($this->Referenciel->removeElement($referenciel)) {
            // set the owning side to null (unless already changed)
            if ($referenciel->getPromo() === $this) {
                $referenciel->setPromo(null);
            }
        }

        return $this;
    }
}
