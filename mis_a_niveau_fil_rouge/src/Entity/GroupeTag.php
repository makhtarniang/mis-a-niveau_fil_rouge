<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GroupeTagRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
/**
 * @ORM\Entity(repositoryClass=GroupeTagRepository::class)
 * @ApiResource(
 * attributes={
 *          "security"="(is_granted('ROLE_Cm') or is_granted('ROLE_Admin'))",
 *          "security_message"="impossible de l'acces",
 *      },
 * collectionOperations={
 *   "get"={
 *         "path"="/admin/grptags",
 *         "normalization_context"={"groups":" GroupeTag_read"},
 *     },
 *   "post"={
 *        "path"="/admin/grptags",
 *       }
 *     },
 * itemOperations={
 *         "get"={
 *              "path"="/admin/grptags/{id1}",
 *     },
 * "get"={
 *        "path"="/admin/grptags/{id}/tags",
 *    
 *     },
 *     "put"={
 *        "path"="/admin/grptags/{id}",
 *     }
 *     }
 * 
 * )
 * @ApiFilter(BooleanFilter::class, properties={"isdeleted"})
 */
class GroupeTag
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
     * @ORM\Column(type="boolean")
     */
    private $isdeleted;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, mappedBy="groupeTags")
     * @ApiSubresource()
     */
    private $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
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

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addGroupeTag($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeGroupeTag($this);
        }

        return $this;
    }
}
