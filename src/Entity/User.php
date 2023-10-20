<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotBlank(message: "Por favor, ingresa un nombre de usuario.")]
    private string $username;

    #[ORM\Column(length: 180, unique: true, nullable: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\OneToMany(mappedBy: "user", targetEntity: UserSwitch::class)]
    private $suscriptions;

    public function __construct()
    {
        $this->suscriptions = new ArrayCollection();
    }



    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
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
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function toJson(): string
    {
        // Crear un arreglo asociativo con las propiedades que deseas incluir en el JSON
        $data = [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'roles' => $this->roles,
            // Agrega otras propiedades según tus necesidades
        ];

        // Accedes a la relación 'followers' si es necesario
        $suscriptionsData = [];
        foreach ($this->getSuscriptions() as $suscription) {
            $suscriptionsData[] = $suscription->toJson();
        }
        $data['suscriptions'] = $suscriptionsData;

        return json_encode($data);
    }

    /**
     * @return Collection|UserSwitch[]
     */
    public function getSuscriptions(): Collection
    {
        return $this->suscriptions;
    }

    public function addSuscription(UserSwitch $switch): self
    {
        if (!$this->suscriptions->contains($switch)) {
            $this->suscriptions[] = $switch;
        }
        return $this;
    }

    public function removeSuscription(UserSwitch $switch): self
    {
        $this->suscriptions->removeElement($switch);
        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
