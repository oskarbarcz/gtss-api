<?php

declare(strict_types=1);

namespace App\Scheduling\Fixture;

use App\Common\Fixture\AbstractFixture;
use App\Scheduling\Entity\Line;
use App\Scheduling\Entity\Train;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

final class TrainFixture extends AbstractFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        /** @var Line $s1Line */
        $s1Line = $this->getReference('00000000-0000-0002-0000-000000000000');

        $train = new Train(Uuid::fromString('00000000-0000-0005-0000-000000000000'));
        $train
            ->setLine($s1Line)
            ->setNumber('S1 8856')
        ;

        $manager->persist($train);
        $manager->flush();

        $this->addEntityReference($train);
    }

    public function getDependencies(): array
    {
        return [LineFixture::class];
    }
}
