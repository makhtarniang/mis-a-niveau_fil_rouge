<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TagRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 * @ApiResource(
 * collectionOperations={
 * "get"={
 *         "path"="admin/tags",
 *         "normalization_context"={"groups":"tag_read"},
 *     },
 * "post"={
 *        "path"="admin/tags",
 *     }
 *     },
 * itemOperations={
 *         "get"={
 *              "path"="admin/tags/{id}",
 *     },
 *     "put"={
 *        "path"="admin/tags/{id}",
 *     }
 *     }
 * )
 * @ApiFilter(BooleanFilter::class, properties={"isdeleted"})
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"tag_read","grpetag_write"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"grpetag_write"})
     */
    private $descriptif;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isdeleted;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeTag::class, inversedBy="tags")
     */
    private $groupeTags;


    public function __construct()
    {
        $this->GroupeTag = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->groupeTags = new ArrayCollection();
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

    /**
     * @return Collection|GroupeTag[]
     */
    public function getGroupeTags(): Collection
    {
        return $this->groupeTags;
    }

    public function addGroupeTag(GroupeTag $groupeTag): self
    {
        if (!$this->groupeTags->contains($groupeTag)) {
            $this->groupeTags[] = $groupeTag;
        }

        return $this;
    }

    public function removeGroupeTag(GroupeTag $groupeTag): self
    {
        $this->groupeTags->removeElement($groupeTag);

        return $this;
    }

   
}
