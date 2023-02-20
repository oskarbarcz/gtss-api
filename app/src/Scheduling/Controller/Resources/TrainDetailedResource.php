<?php

declare(strict_types=1);

namespace App\Scheduling\Controller\Resources;

use App\Scheduling\Entity\Stop;
use App\Scheduling\Entity\Train;
use Symfony\Component\Uid\Uuid;

final class TrainDetailedResource
{
    public readonly Uuid $id;
    public readonly string|null $number;

    /** @var Uuid[] */
    public array $stations;

    public function __construct(Train $train)
    {
        $this->id = $train->getId();
        $this->number = $train->getNumber();

        /** @var Stop $stop */
        foreach ($train->getStops() as $stop) {
            $this->stations[] = $stop->getStation()->getId();
        }
    }
}
