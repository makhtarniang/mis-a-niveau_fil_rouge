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
 *       denormalizationContext={"groups"={"competance_write"}},
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
 *     },
 * "delete"={
 *       "method"="DELETE",
 *       "path"="admin/competences/{id}",
 *       "security"="is_granted('ROLE_Admin')",
 *       "security_message"="Impossible de l'acces",
 *     },
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
     * @Groups({"grpcompetance_read","referenciel_read","competance_write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"competance_read","get","grpcompetance_read","referenciel_read","competance_write"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"competance_read","grpcompetance_read","referenciel_read","competance_write"})
     */
    private $descriptif;

    /**
     * @ORM\Column(type="boolean")
     * @ORM\Column(type="boolean", name="isdeleted", options={"default":false})
     * @Groups({"competance_read","competance_write"})
     */
    private $isdeleted =false;

    /**
     * @ORM\OneToMany(targetEntity=Niveau::class, mappedBy="competance",cascade={"persist"})
     * @Groups({"competance_read","get","competance_write"})
     
     */
    private $niveau;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeCometance::class, mappedBy="Competance")
     * @Groups({"competance_write"})
     */
    private $groupeCometances;

    

   

    public function __construct()
    {
        $this->niveau = new ArrayCollection();
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
            $groupeCometance->addCompetance($this);
        }

        return $this;
    }

    public function removeGroupeCometance(GroupeCometance $groupeCometance): self
    {
        if ($this->groupeCometances->removeElement($groupeCometance)) {
            $groupeCometance->removeCompetance($this);
        }

        return $this;
    }

}
