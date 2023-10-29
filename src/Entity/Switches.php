<?php

namespace App\Entity;

use App\Repository\SwitchesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Validator\Constraints\Json;

#[ORM\Entity(repositoryClass: SwitchesRepository::class)]
class Switches
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, length: 400, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $state = false;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $clickDateStart = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $clickDateEnd = null;

    #[ORM\ManyToOne(inversedBy: 'switches')]
    private ?User $owner = null;

    #[ORM\OneToMany(mappedBy: "switch", targetEntity: UserSwitch::class, cascade: ["remove"])]
    private $followers;

    #[ORM\Column(type: UuidType::NAME)]
    private ?Uuid $publicUri;

    #[ORM\Column(type: UuidType::NAME)]
    private ?Uuid $privateUri;

    public function __construct()
    {
        $this->publicUri = Uuid::v4();
        $this->privateUri = Uuid::v4();
        $this->followers = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isState(): ?bool
    {
        return $this->state;
    }

    public function setState(bool $state): static
    {
        $this->state = $state;

        return $this;
    }

    public function getClickDateStart(): ?\DateTimeInterface
    {
        return $this->clickDateStart;
    }

    public function setClickDateStart(?\DateTimeInterface $clickDateStart): static
    {
        $this->clickDateStart = $clickDateStart;

        return $this;
    }

    public function getClickDateEnd(): ?\DateTimeInterface
    {
        return $this->clickDateEnd;
    }

    public function setClickDateEnd(?\DateTimeInterface $clickDateEnd): static
    {
        $this->clickDateEnd = $clickDateEnd;

        return $this;
    }

    public function getPublicUri(): ?Uuid
    {
        return $this->publicUri;
    }

    public function setPublicUri(?Uuid $publicUri): static
    {
        $this->publicUri = $publicUri;
        return $this;
    }

    public function getPrivateUri(): ?Uuid
    {
        return $this->privateUri;
    }

    public function setPrivateUri(?Uuid $privateUri): static
    {
        $this->privateUri = $privateUri;
        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection|UserSwitch[]
     */
    public function getFollowers(): Collection
    {
        return $this->followers;
    }

    public function addFollower(UserSwitch $follower): self
    {
        if (!$this->followers->contains($follower)) {
            $this->followers[] = $follower;
            $follower->getUser()->addSuscription($follower);
        }
        return $this;
    }

    public function removeFollower(UserSwitch $follower): self
    {
        if ($this->followers->removeElement($follower)) {
            $follower->getUser()->removeSuscription($follower);
        }
        return $this;
    }

    public function toJson(): array
    {
        $data = [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'state' => $this->isState(),
            'clickDateStart' => $this->getClickDateStart(),
            'clickDateEnd' => $this->getClickDateEnd(),
            'publicUri' => $this->getPublicUri(),
            'privateUri' => $this->getPrivateUri(),
            // ... Puedes agregar más propiedades según sea necesario
        ];

        // Accedes a la relación 'owner' si es necesario
        if ($this->getOwner()) {
            $data['owner'] = [
                'id' => $this->getOwner()->getId(),
                'username' => $this->getOwner()->getUsername(),
                // ... Agrega más propiedades del usuario propietario
            ];
        }

        // Accedes a la relación 'followers' si es necesario
        $followersData = [];
        foreach ($this->getFollowers() as $follower) {
            $followersData[] = $follower->toJson();
        }
        $data['followers'] = $followersData;


        return $data;
    }
}
