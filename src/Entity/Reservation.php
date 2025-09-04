<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $duration = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTime $doDay = null;

    #[ORM\Column]
    private ?int $status = null;

    #[ORM\Column]
    private array $historical = [];

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?User $user = null;

    /**
     * @var Collection<int, Practice>
     */
    #[ORM\ManyToMany(targetEntity: Practice::class, mappedBy: 'reservations')]
    private Collection $practices;

    public function __construct()
    {
        $this->practices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDoDay(): ?\DateTime
    {
        return $this->doDay;
    }

    public function setDoDay(\DateTime $doDay): static
    {
        $this->doDay = $doDay;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getHistorical(): array
    {
        return $this->historical;
    }

    public function setHistorical(array $historical): static
    {
        $this->historical = $historical;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Practice>
     */
    public function getPractices(): Collection
    {
        return $this->practices;
    }

    public function addPractice(Practice $practice): static
    {
        if (!$this->practices->contains($practice)) {
            $this->practices->add($practice);
            $practice->addReservation($this);
        }

        return $this;
    }

    public function removePractice(Practice $practice): static
    {
        if ($this->practices->removeElement($practice)) {
            $practice->removeReservation($this);
        }

        return $this;
    }
}
