<?php

namespace App\Entity;

use App\Entity\Apprenant;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ProfilSortieController;
use App\Repository\ProfilSortieRepository;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  normalizationContext={"groups"={"profilSortie_read"}},
 *  denormalizationContext={"groups"={"profilSortie_write"},"enable_max_depth="=true} ,
 *  collectionOperations={
  * "post"={
 *          "method"="POST",
 *          "path"="/admin/profilsorties",
 *          "security"="is_granted('ROLE_Admin')",
 *          "security_message"="Vous n'avez pas l'acces",
 *          "controller"="App\Controller\ProfilSortieController::postprofilDeSorti"
 *    },
 *  "get"={
 *          "method"="GET",
 *          "path"="/admin/profilsorties",
 *          "security"="is_granted('ROLE_Admin')",
 *          "security_message"="Impossible de l'acces",
 *          },
 * "getshowPromoProfil"={  
 *              "method"="GET", 
 *              "path"="/admin/promo/{id}/profilsorties/{id1}", 
 *                },
 * },
 * itemOperations={
 * "getPromoProfilById"={
 *              "method"="GET", 
 *              "path"="/admin/profilsorties/{id}",
 *           
 *                },
 *  "getprofildesortiappranant"={
 *              "method"="GET", 
 *              "path"="api/admin/promo/{id}/profilsorties",
 * },
 * "put"={
 *       "method"="PUT",
 *       "path"="/admin/profilsorties/{id}",
 *       "security"="is_granted('ROLE_Admin')",
 *       "security_message"="Impossible de l'acces",
 *     },
 * * "delete"={
 *       "method"="DELETE",
 *       "path"="/admin/profilsorties/{id}",
 *       "security"="is_granted('ROLE_Admin')",
 *       "security_message"="Impossible de l'acces",
 *     },
 * }
 * )
 * @ORM\Entity(repositoryClass=ProfilSortieRepository::class)
 */
class ProfilSortie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"profilSortie_read","profilSortie_write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"profilSortie_read","profilSortie_write"})
     * @Assert\NotBlank(
     *     message="Champ est vide"
     * )
     */
    private $libelle;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isdeleted=false;
    /**
     * @ORM\OneToMany(targetEntity=Apprenant::class, mappedBy="ProfilSortie")
     * @Groups({"profilSortie_write"})
     */

    private $apprenant;

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

    public function getApprenant(): ?Apprenant
    {
        return $this->apprenant;
    }

    public function setApprenant(?Apprenant $apprenant): self
    {
        $this->apprenant = $apprenant;

        return $this;
    }
}
