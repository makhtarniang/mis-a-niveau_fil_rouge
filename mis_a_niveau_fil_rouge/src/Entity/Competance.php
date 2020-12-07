<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CompetanceRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ApiResource(
 *       normalizationContext={"groups"={"competance_read"}},
 * collectionOperations={
 * "get"={
 *       "method"="GET",
 *       "path"="/admin/competences",
 *       "defaults"={"id"=null}
 *     },
 * "post"={
 *          "path"="admin/competences",
 *          "method"="POST",

 *       }
 *     },
 * itemOperations={
 *         "get"={
 *              "path"="admin/competences/{id}",
 *               
 *     },
 *     "put"={
 *        "path"="admin/competences/{id}",
 *     }
 *     }
 * )
 * @ApiFilter(BooleanFilter::class, properties={"isdeleted"})
 * @ORM\Entity(repositoryClass=CompetanceRepository::class)
 * @UniqueEntity(
 *      fields={"libelle"},
 *      message="Ce libellé existe déjà"
 * )
 */
class Competance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"grpcompetance_read","referenciel_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"competance_read","get","grpcompetance_read","referenciel_read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"competance_read","grpcompetance_read","referenciel_read"})
     */
    private $descriptif;

    /**
     * @ORM\Column(type="boolean")
     * @ORM\Column(type="boolean", name="isdeleted", options={"default":false})
     * @Groups({"competance_read"})
     */
    private $isdeleted;

    /**
     * @ORM\OneToMany(targetEntity=Niveau::class, mappedBy="competance")
     * @Groups({"competance_read","get"})
     
     */
    private $niveau;

    /**
     * @ORM\ManyToMany(targetEntity=Competance::class, inversedBy="competances")
     * @Groups({"referenciel_read"})
     */
    private $GroupeCompetance;

    public function __construct()
    {
        $this->niveau = new ArrayCollection();
        $this->GroupeCompetance = new ArrayCollection();
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

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): self
    {
        $this->descriptif = $descriptif;

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

    public function getCompetance(): ?self
    {
        return $this->competance;
    }

    public function setCompetance(?self $competance): self
    {
        $this->competance = $competance;

        return $this;
    }

    /**
     * @return Collection|Niveau[]
     */
    public function getNiveau(): Collection
    {
        return $this->niveau;
    }

    public function addNiveau(Niveau $niveau): self
    {
        if (!$this->niveau->contains($niveau)) {
            $this->niveau[] = $niveau;
            $niveau->setCompetance($this);
        }

        return $this;
    }

    public function removeNiveau(Niveau $niveau): self
    {
        if ($this->niveau->removeElement($niveau)) {
            // set the owning side to null (unless already changed)
            if ($niveau->getCompetance() === $this) {
                $niveau->setCompetance(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getGroupeCompetance(): Collection
    {
        return $this->GroupeCompetance;
    }

    public function addGroupeCompetance(self $groupeCompetance): self
    {
        if (!$this->GroupeCompetance->contains($groupeCompetance)) {
            $this->GroupeCompetance[] = $groupeCompetance;
        }

        return $this;
    }

    public function removeGroupeCompetance(self $groupeCompetance): self
    {
        $this->GroupeCompetance->removeElement($groupeCompetance);

        return $this;
    }
}
