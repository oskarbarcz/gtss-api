<?php

declare(strict_types=1);

namespace App\Scheduling\Entity;

use App\Geolocation\Entity\Station;
use App\Scheduling\Repository\StopRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: StopRepository::class)]
class Stop
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private Uuid $id;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?\DateTimeInterface $scheduledArrivalTime = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?\DateTimeImmutable $scheduledDepartureTime = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $predictedArrivalTime = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $predictedDepartureTime = null;

    #[ORM\ManyToOne(inversedBy: 'stops')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Train $train = null;

    #[ORM\ManyToOne(inversedBy: 'stops')]
    #[ORM\JoinColumn(nullable: false)]
    private Station $station;

    public function __construct(Uuid $id)
    {
        $this->id = $id;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getScheduledArrivalTime(): ?\DateTimeInterface
    {
        return $this->scheduledArrivalTime;
    }

    public function setScheduledArrivalTime(\DateTimeInterface $scheduledArrivalTime): self
    {
        $this->scheduledArrivalTime = $scheduledArrivalTime;

        return $this;
    }

    public function getScheduledDepartureTime(): ?\DateTimeImmutable
    {
        return $this->scheduledDepartureTime;
    }

    public function setScheduledDepartureTime(\DateTimeImmutable $scheduledDepartureTime): self
    {
        $this->scheduledDepartureTime = $scheduledDepartureTime;

        return $this;
    }

    public function getPredictedArrivalTime(): ?\DateTimeImmutable
    {
        return $this->predictedArrivalTime;
    }

    public function setPredictedArrivalTime(\DateTimeImmutable $predictedArrivalTime): self
    {
        $this->predictedArrivalTime = $predictedArrivalTime;

        return $this;
    }

    public function getPredictedDepartureTime(): ?\DateTimeImmutable
    {
        return $this->predictedDepartureTime;
    }

    public function setPredictedDepartureTime(?\DateTimeImmutable $predictedDepartureTime): self
    {
        $this->predictedDepartureTime = $predictedDepartureTime;

        return $this;
    }

    public function getTrain(): ?Train
    {
        return $this->train;
    }

    public function setTrain(?Train $train): self
    {
        $this->train = $train;

        return $this;
    }

    public function getStation(): Station
    {
        return $this->station;
    }

    public function setStation(Station $station): self
    {
        $this->station = $station;

        return $this;
    }
}
