<?php

declare(strict_types=1);

namespace App\Geolocation\Entity;

use App\Common\Entity\UuidAwareEntityInterface;
use App\Geolocation\Repository\StationRepository;
use App\Scheduling\Entity\Stop;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: StationRepository::class)]
class Station implements UuidAwareEntityInterface
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private Uuid $id;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shortName = null;

    #[ORM\Column(length: 255)]
    private ?string $fullName = null;

    #[ORM\ManyToOne(inversedBy: 'stations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?City $city = null;

    #[ORM\OneToMany(mappedBy: 'station', targetEntity: Stop::class, orphanRemoval: true)]
    private Collection $stops;

    public function __construct(Uuid $id)
    {
        $this->id = $id;
        $this->stops = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    public function setShortName(?string $shortName): self
    {
        $this->shortName = $shortName;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection<int, Stop>
     */
    public function getStops(): Collection
    {
        return $this->stops;
    }

    public function addStop(Stop $stop): self
    {
        if (!$this->stops->contains($stop)) {
            $this->stops->add($stop);
            $stop->setStation($this);
        }

        return $this;
    }
}
