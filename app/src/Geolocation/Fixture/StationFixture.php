<?php

declare(strict_types=1);

namespace App\Geolocation\Fixture;

use App\Common\Fixture\AbstractFixture;
use App\Geolocation\Entity\City;
use App\Geolocation\Entity\Station;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

final class StationFixture extends AbstractFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        /** @var City $frankfurtCity */
        $frankfurtCity = $this->getReference('00000000-0000-0003-0000-000000000000');

        $frankfurtMainStation = new Station(Uuid::fromString('00000000-0000-0004-0000-000000000000'));
        $frankfurtMainStation
            ->setCity($frankfurtCity)
            ->setShortName('Frankfurt(Main) Hbf')
            ->setFullName('Frankfurt am Main Hauptbahnhof')
        ;

        $frankfurtLowerStation = new Station(Uuid::fromString('00000000-0000-0004-0000-000000000001'));
        $frankfurtLowerStation
            ->setCity($frankfurtCity)
            ->setShortName('Frankfurt(Main) Niederrad')
            ->setFullName('Frankfurt am Main Niederrad')
        ;

        $frankfurtStadionStation = new Station(Uuid::fromString('00000000-0000-0004-0000-000000000002'));
        $frankfurtStadionStation
            ->setCity($frankfurtCity)
            ->setShortName('Frankfurt(Main) Stadion')
            ->setFullName('Frankfurt am Main Stadion')
        ;

        $frankfurtAirportStation = new Station(Uuid::fromString('00000000-0000-0004-0000-000000000003'));
        $frankfurtAirportStation
            ->setCity($frankfurtCity)
            ->setShortName('Frankfurt(Main) Flughafen')
            ->setFullName('Frankfurt am Main Flughafen')
        ;

        $manager->persist($frankfurtMainStation);
        $manager->persist($frankfurtLowerStation);
        $manager->persist($frankfurtStadionStation);
        $manager->persist($frankfurtAirportStation);
        $manager->flush();

        $this->addEntityReference($frankfurtMainStation);
        $this->addEntityReference($frankfurtLowerStation);
        $this->addEntityReference($frankfurtStadionStation);
        $this->addEntityReference($frankfurtAirportStation);
    }

    public function getDependencies(): array
    {
        return [CityFixture::class];
    }
}
