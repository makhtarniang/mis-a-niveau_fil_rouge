<?php
namespace App\Entity;
use App\Entity\Profil;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfilRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
* @ApiResource(
 * attributes={
 *        "security"="(is_granted('ROLE_Admin') or is_granted('ROLE_Formateur'))",
 *          "security_message"="impossible de l'acces",
 *          "normalization_context"={"groups"={"profil_read"},"enable_max_depth="=true}
 *           
 *      },
 * collectionOperations={
 *  "post"={
 *       "method"="POST",
 *       "path"="admin/profils"
 *     },
 *  "get"=
 *        {
 *       "method"="GET",
 *       "path"="admin/profils"
 *          }
 *     },
 * itemOperations={
 *       "get"={
 *          "method"="GET",
 *          "path"="admin/profils/{id}",
 *          "defaults"={"id"=null}
 *     },
 *     "put"={
 *          "method"="PUT",
 *          "path"="admin/profils/{id}",
 *     }
 *    }
 * )
 * @ApiFilter(BooleanFilter::class, properties={"isdeleted"})
 * @ORM\Entity(repositoryClass=ProfilRepository::class)
 * @UniqueEntity(
 *      fields={"libelle"},
 *      message="Ce libellé existe déjà"
 * )
 */
class Profil
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"profil_read"}) 
     * @Groups({"user:write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"profil_read","user_read"}) 
     * @Groups({"user:write"})
     * @Assert\NotBlank(
     *     message="Champ libelle est vide"
     * )
     */
    private $libelle;

    /**
     * @ORM\Column(type="boolean", name="is_deleted", options={"default":false})
     */
    private $is_deleted;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="profil")
     * 
     */
    private $users;


    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->setIsDeleted(false);
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

    public function getIsDeleted(): ?bool
    {
        return $this->is_deleted;
    }

    public function setIsDeleted(bool $is_deleted): self
    {
        $this->is_deleted = $is_deleted;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setProfil($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getProfil() === $this) {
                $user->setProfil(null);
            }
        }

        return $this;
    }


}
