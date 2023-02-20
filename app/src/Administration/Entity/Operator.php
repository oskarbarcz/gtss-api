<?php

declare(strict_types=1);

namespace App\Administration\Entity;

use App\Administration\Repository\OperatorRepository;
use App\Common\Entity\UuidAwareEntityInterface;
use App\Scheduling\Entity\Line;
use App\Scheduling\Entity\ScheduleRequest;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: OperatorRepository::class)]
class Operator implements UuidAwareEntityInterface
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private Uuid $id;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\OneToMany(mappedBy: 'operator', targetEntity: Line::class, orphanRemoval: true)]
    private Collection $ranLines;

    #[ORM\OneToMany(mappedBy: 'operator', targetEntity: ScheduleRequest::class)]
    private Collection $scheduleRequests;

    public function __construct(Uuid $id)
    {
        $this->id = $id;
        $this->ranLines = new ArrayCollection();
        $this->scheduleRequests = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Line>
     */
    public function getRanLines(): Collection
    {
        return $this->ranLines;
    }

    public function addRanLine(Line $ranLine): self
    {
        if (!$this->ranLines->contains($ranLine)) {
            $this->ranLines->add($ranLine);
            $ranLine->setOperator($this);
        }

        return $this;
    }

    public function removeRanLine(Line $ranLine): self
    {
        if ($this->ranLines->removeElement($ranLine)) {
            // set the owning side to null (unless already changed)
            if ($ranLine->getOperator() === $this) {
                $ranLine->setOperator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ScheduleRequest>
     */
    public function getScheduleRequests(): Collection
    {
        return $this->scheduleRequests;
    }

    public function addScheduleRequest(ScheduleRequest $scheduleRequest): self
    {
        if (!$this->scheduleRequests->contains($scheduleRequest)) {
            $this->scheduleRequests->add($scheduleRequest);
            $scheduleRequest->setOperator($this);
        }

        return $this;
    }

    public function removeScheduleRequest(ScheduleRequest $scheduleRequest): self
    {
        if ($this->scheduleRequests->removeElement($scheduleRequest)) {
            // set the owning side to null (unless already changed)
            if ($scheduleRequest->getOperator() === $this) {
                $scheduleRequest->setOperator(null);
            }
        }

        return $this;
    }
}
