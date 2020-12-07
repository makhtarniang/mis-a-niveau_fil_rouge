<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReferencielRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource(
 * * attributes={
 *          "security"="(is_granted('ROLE_Admin') or is_granted('ROLE_Formateur'))",
 *          "security_message"="impossible de l'acces",
 *          },
 *        denormalizationContext={"groups"={"referanciel_write"},"enable_max_depth="=true} ,
 *        normalizationContext={"groups"={"referenciel_read"}},
 * collectionOperations={
 *    "getall"={
 *       "path"="admin/referentiels",
 *         "method"="GET",
 *         "normalization_context"={"groups"={"referenciel_read"}},
 *    },
 *     "createRef"={
 *         "path"="admin/referentiels",
 *         "method"="POST",
 *         "deserialize"=false,
 *         "denormalization_context"={"groups"={"referanciel_write"},"enable_max_depth="=true},
 *     },
 *     "get"={
 *          "method"="GET",
 *          "path"="admin/referentiels/grpecompetences",
 *          "normalization_context"={"groups"={"referenciel_read"}},
 *     }
 *     },
 *     itemOperations={
 *      "post"={
 *         "path"="admin/referentiels/{id}",
 *         "method"="get",
 *     },
 *     "get"={
 *        "method"="GET",
 *        "path"="admin/referentiels/{id}/grpecompetences",
 *     },
 *     "get"={
 *               "method"="GET",
 *               "path"="admin/referentiels/{id}/grpecompetences/{groupeCompetence}",
 *     },
 *      "put"={
 *         "method"="PUT",
 *         "path"="admin/referentiels/{id}",
 *     },
 *     }
 * )
 * @ORM\Entity(repositoryClass=ReferencielRepository::class)
 * @UniqueEntity(
 *      fields={"libelle"},
 *      message="Ce libellé existe déjà"
 * )
 */
class Referenciel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"referenciel_read"})
     * @Groups({"referanciel_write"})
     */
    private $id;

    /**
     * @Groups({"referenciel_read"})
     * @Groups({"referanciel_write"})
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="Champ libelle est vide"
     * )
     */
    private $libelle;

    /**
     * @ORM\Column(type="text")
     * @Groups({"referenciel_read"})
     * @Groups({"referanciel_write"})
     */
    private $presentation;

    /**
     * @ORM\Column(type="blob")
     * @Groups({"referanciel_write"})
     */
    private $programme;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"referenciel_read"})
     * @Groups({"referanciel_write"})
     */
    private $critairEvaluation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"referenciel_read"})
     * @Groups({"referanciel_write"})
     */
    private $criterAdmission;
    /**
     * @ORM\Column(type="boolean")
     */
    private $isdeleted;

    /**
     * @ORM\ManyToOne(targetEntity=Promo::class, inversedBy="Referenciel")
     * @ORM\JoinColumn(nullable=false)
     */
    private $promo;

    
    /**
     * @ORM\ManyToMany(targetEntity=GroupeCometance::class, mappedBy="Referenciel")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"referenciel_read"})
     * @Groups({"referanciel_write"})
     */
    private $groupeCometances;

    

    public function __construct()
    {
        $this->Promo = new ArrayCollection();
        $this->GroupeCompetance = new ArrayCollection();
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

    public function getPromo(): ?Promo
    {
        return $this->promo;
    }

    public function setPromo(?Promo $promo): self
    {
        $this->promo = $promo;

        return $this;
    }

   
    /**
     * @return Collection|GroupeCometance[]
     */
    public function getGroupeCometances(): Collection
    {
        return $this->groupeCometances;
    }

    public function addGroupeCometance(GroupeCometance $groupeCometance): self
    {
        if (!$this->groupeCometances->contains($groupeCometance)) {
            $this->groupeCometances[] = $groupeCometance;
            $groupeCometance->addReferenciel($this);
        }

        return $this;
    }

    public function removeGroupeCometance(GroupeCometance $groupeCometance): self
    {
        if ($this->groupeCometances->removeElement($groupeCometance)) {
            $groupeCometance->removeReferenciel($this);
        }

        return $this;
    }

    
}
