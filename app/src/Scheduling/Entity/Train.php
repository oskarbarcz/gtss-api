<?php

declare(strict_types=1);

namespace App\Scheduling\Entity;

use App\Common\Entity\UuidAwareEntityInterface;
use App\Scheduling\Repository\TrainRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: TrainRepository::class)]
class Train implements UuidAwareEntityInterface
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private Uuid $id;

    #[ORM\Column(length: 255)]
    private ?string $number = null;

    #[Ignore]
    #[ORM\ManyToOne(inversedBy: 'trains')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Line $line = null;

    #[Ignore]
    #[ORM\OneToMany(mappedBy: 'train', targetEntity: Stop::class, orphanRemoval: true)]
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

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getLine(): ?Line
    {
        return $this->line;
    }

    public function setLine(?Line $line): self
    {
        $this->line = $line;

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
            $stop->setTrain($this);
        }

        return $this;
    }

    public function removeStop(Stop $stop): self
    {
        if ($this->stops->removeElement($stop)) {
            // set the owning side to null (unless already changed)
            if ($stop->getTrain() === $this) {
                $stop->setTrain(null);
            }
        }

        return $this;
    }
}
