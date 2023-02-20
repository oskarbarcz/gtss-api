<?php

declare(strict_types=1);

namespace App\Geolocation\Fixture;

use App\Common\Fixture\AbstractFixture;
use App\Geolocation\Entity\City;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

final class CityFixture extends AbstractFixture
{
    public function load(ObjectManager $manager): void
    {
        $frankfurtCity = new City(Uuid::fromString('00000000-0000-0003-0000-000000000000'));
        $frankfurtCity->setName('Frankfurt am Main');

        $wiesbadenCity = new City(Uuid::fromString('00000000-0000-0003-0000-000000000001'));
        $wiesbadenCity->setName('Wiesbaden');

        $manager->persist($frankfurtCity);
        $manager->persist($wiesbadenCity);
        $manager->flush();

        $this->addEntityReference($frankfurtCity);
        $this->addEntityReference($wiesbadenCity);
    }
}
