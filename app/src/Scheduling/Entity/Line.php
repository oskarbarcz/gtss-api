<?php

declare(strict_types=1);

namespace App\Scheduling\Entity;

use App\Administration\Entity\Operator;
use App\Common\Entity\UuidAwareEntityInterface;
use App\Scheduling\Repository\LineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: LineRepository::class)]
class Line implements UuidAwareEntityInterface
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private Uuid $id;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'ranLines')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Operator $operator = null;

    #[ORM\OneToMany(mappedBy: 'line', targetEntity: Train::class, orphanRemoval: true)]
    private Collection $trains;

    public function __construct(Uuid $id)
    {
        $this->id = $id;
        $this->trains = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getOperator(): ?Operator
    {
        return $this->operator;
    }

    public function setOperator(?Operator $operator): self
    {
        $this->operator = $operator;

        return $this;
    }

    /**
     * @return Collection<int, Train>
     */
    public function getTrains(): Collection
    {
        return $this->trains;
    }

    public function addTrain(Train $train): self
    {
        if (!$this->trains->contains($train)) {
            $this->trains->add($train);
            $train->setLine($this);
        }

        return $this;
    }

    public function removeTrain(Train $train): self
    {
        if ($this->trains->removeElement($train)) {
            // set the owning side to null (unless already changed)
            if ($train->getLine() === $this) {
                $train->setLine(null);
            }
        }

        return $this;
    }
}
