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
/**
 * @ORM\Entity(repositoryClass=CompetanceRepository::class)
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

 */
class Competance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"competance_read","get"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"competance_read"})
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


    public function __construct()
    {
        $this->niveau = new ArrayCollection();
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

   

}
