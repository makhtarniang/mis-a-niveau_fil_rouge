<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GroupeTagRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @UniqueEntity(
 *      fields={"libelle"},
 *      message="Ce libellé existe déjà"
 * )
 * @ApiResource(
 * denormalizationContext={"groups"={"grpetag_write"}},
 * attributes={
 *          "security"="(is_granted('ROLE_Cm') or is_granted('ROLE_Admin'))",
 *          "security_message"="impossible de l'acces",
 *      },
 * collectionOperations={
 *   "get"={
 *         "path"="/admin/grptags",
 *        },
 * "postgrpetag"={
 *        "method"="POST",
 *        "path"="admin/grpetags",
 *        "route_name"="creategrptag",
 *        "defaults"={"id"=null}
 * 
 *     },
 *     },
 * itemOperations={
 *         "getall"={
 *              "path"="/admin/grptags/{id}",
 *              "method"="GET",
 *     },
 * "getall"={
 *        "path"="/admin/grptags/{id}/tags",
 *         "method"="GET",
 *     },
 *     "updateGrpTag"={
 *          "path"="admin/grpetags/{id}",
 *          "method"="PUT",
 *     }
 *     }
 * 
 * )
 * @ApiFilter(BooleanFilter::class, properties={"isdeleted"})
 * @ORM\Entity(repositoryClass=GroupeTagRepository::class)
 * @UniqueEntity(
 *      fields={"libelle"},
 *      message="Ce libellé existe déjà"
 * )
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
     * @Groups({"GroupeTag_read","grpetag_write"})
     * @Assert\Unique
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
     * @ORM\ManyToMany(targetEntity=Tag::class, mappedBy="groupeTags")
     * @ApiSubresource()
     * @Groups({"grpetag_write"})
     */
    private $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
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
