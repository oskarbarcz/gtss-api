<?php

declare(strict_types=1);

namespace App\Scheduling\Fixture;

use App\Common\Fixture\AbstractFixture;
use App\Geolocation\Entity\Station;
use App\Geolocation\Fixture\StationFixture;
use App\Scheduling\Entity\Stop;
use App\Scheduling\Entity\Train;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

final class StopFixture extends AbstractFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        /** @var Station $frankfurtMainStation */
        $frankfurtMainStation = $this->getReference('00000000-0000-0004-0000-000000000000');

        /** @var Station $frankfurtLowerStation */
        $frankfurtLowerStation = $this->getReference('00000000-0000-0004-0000-000000000001');

        /** @var Station $frankfurtStadionStation */
        $frankfurtStadionStation = $this->getReference('00000000-0000-0004-0000-000000000002');

        /** @var Station $frankfurtAirportStation */
        $frankfurtAirportStation = $this->getReference('00000000-0000-0004-0000-000000000003');

        /** @var Train $train */
        $train = $this->getReference('00000000-0000-0005-0000-000000000000');

        $stop1 = new Stop(Uuid::fromString('00000000-0000-0006-0000-000000000000'));
        $stop1
            ->setTrain($train)
            ->setStation($frankfurtMainStation)
            ->setScheduledArrivalTime(new \DateTimeImmutable('2022-01-01 6:00'))
            ->setScheduledDepartureTime(new \DateTimeImmutable('2022-01-01 6:02'))
        ;

        $stop2 = new Stop(Uuid::fromString('00000000-0000-0006-0000-000000000001'));
        $stop2
            ->setTrain($train)
            ->setStation($frankfurtLowerStation)
            ->setScheduledArrivalTime(new \DateTimeImmutable('2022-01-01 6:08'))
            ->setScheduledDepartureTime(new \DateTimeImmutable('2022-01-01 6:09'))
        ;

        $stop3 = new Stop(Uuid::fromString('00000000-0000-0006-0000-000000000002'));
        $stop3
            ->setTrain($train)
            ->setStation($frankfurtStadionStation)
            ->setScheduledArrivalTime(new \DateTimeImmutable('2022-01-01 6:12'))
            ->setScheduledDepartureTime(new \DateTimeImmutable('2022-01-01 6:12'))
        ;

        $stop4 = new Stop(Uuid::fromString('00000000-0000-0006-0000-000000000003'));
        $stop4
            ->setTrain($train)
            ->setStation($frankfurtAirportStation)
            ->setScheduledArrivalTime(new \DateTimeImmutable('2022-01-01 6:13'))
            ->setScheduledDepartureTime(new \DateTimeImmutable('2022-01-01 6:15'))
        ;

        $manager->persist($stop1);
        $manager->persist($stop2);
        $manager->persist($stop3);
        $manager->persist($stop4);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [LineFixture::class, StationFixture::class, TrainFixture::class];
    }
}
