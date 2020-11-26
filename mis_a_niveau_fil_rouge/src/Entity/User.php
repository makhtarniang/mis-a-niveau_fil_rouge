<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping\InheritanceType;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\DiscriminatorMap;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap ({"formateur"="Formateur","apprenant" = "Apprenant", "cm" = "CM", "user" = "User"})
 * @ApiResource(
 *     collectionOperations={
 *          "get"={
 *              "method"="GET",
 *              "path"="admin/users",
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="impossible de l'acces"
 *     },
 *     "postUser"={
 *               "method"="POST",
 *              "path"="admin/users",
 *              "route_name"="createUser",
 *              "deserialize"=false,
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="impossible de l'acces",
 *    },
 *     },
 *     itemOperations={
 *         "get",
 *         "get"={
 *              "method"="GET",
 *              "path"="admin/users/{id}",
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="impossible de l'acces"
 *     },
 * 
 *       "editUser"={
 *          "path"="admin/users/{id}",
 *          "method"="PUT",
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
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"user_read"})
     * @Assert\Email(
     *     message = "email invalid."
     * )
     */
    private $email;


    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_read"})
     * @Assert\NotBlank(
     *     message="Champ nom vide"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_read"})
     * @Assert\NotBlank(
     *     message="Champ prenom vide"
     * )
     */
    private $prenom;

    /**
     * @ORM\ManyToOne(targetEntity=Profil::class, inversedBy="users")
     * 
     */
    private $profil;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $avatar;


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
        return $this->avatar;
    }

    public function setAvatar($avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

}
