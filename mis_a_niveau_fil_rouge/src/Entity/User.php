<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping\InheritanceType;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\DiscriminatorMap;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap ({"formateur"="Formateur","apprenant" = "Apprenant", "cm" = "CM", "user" = "User"})
 * @ApiResource(
 *     normalizationContext={"groups"={"user_read"}},
 *     denormalizationContext={"groups":"user:write"},
 *   collectionOperations={
 *      "get"={
 *             "method"="GET",
 *              "path"="admin/users",
 *              "deserialize"=false,
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Impossible l'acces"
 *     },
 *     "createUser"={
 *               "method"="POST",
 *              "path"="admin/users",
 *              "deserialize"=false,
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="impossible de l'acces",
 *    },
 *     },
 *     itemOperations={
 *         "getall"={
 *              "method"="GET",
 *              "path"="admin/users/{id}",
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="impossible de l'acces"
 *          },
 * 
 *  "updateUser"={
 *               "method"="PUT",
 *               "path"="admin/users/{id}",
 *               "deserialize"=false,
 *               "security"="is_granted('ROLE_Admin')",
 *               "security_message"="impossible de l'acces",
 *    },
 * "delete"={
 *          "path"="admin/user/{id}",
 *          "method"="DELETE",
 *          "security"="is_granted('ROLE_Admin')",
 *          "security_message"="impossible de l'acces"
 *      },
 *     }
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user_read","groupe_read","get","profilSortie_read"})
     * @Groups({"groupe_write","profilSortie_write"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"user_read","groupe_read","get","profilSortie_read"})
     * @Groups({"groupe_write","profilSortie_write", "user:write"})
     * @Assert\Email(
     *     message = "email invalid."
     * )
     * @Assert\NotBlank(
     *     message="Champ mail est vide"
     * )
     */
    private $email;


    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups({"groupe_write", "user:write"})
     * @Groups({"groupe_read"})
     * @Assert\NotBlank(
     *     message="Champ password est vide"
     * )
     */
    private $password;
     
    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_read","groupe_read","get", "user:write"})
     * @Assert\NotBlank(
     *     message="Champ nom vide"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_read","groupe_read","get","profilSortie_read"})
     * @Groups({"groupe_write","profilSortie_write", "user:write"})
     * @Assert\NotBlank(
     *     message="Champ prenom vide"
     * )
     */
    private $prenom;

    /**
     * @Groups({"profil_read","user_read","profilSortie_read"})
     * @ORM\ManyToOne(targetEntity=Profil::class, inversedBy="users")
     * @ApiSubresource()
     */
    private $profil;

    /**
     * @ORM\Column(type="blob", nullable=true)
     * @Groups({"groupe_read","get","user_read","profilSortie_write"})
     * @Groups({"groupe_write","profilSortie_write"})
     */
    private $avatar;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"groupe_write","profilSortie_write","profilSortie_write", "user:write"})
     */
    private $isdeleted;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_'.$this->profil->getLibelle();

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    public function getAvatar()
    {
        if($this->avatar)
        {
            $avatar_str= stream_get_contents($this->avatar);
            return base64_encode($avatar_str);
        }
        return null;
    }

    public function setAvatar($avatar): self
    {
        $this->avatar = $avatar;

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

}
