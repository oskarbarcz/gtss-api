<?php

declare(strict_types=1);

namespace App\Scheduling\Fixture;

use App\Administration\Entity\Operator;
use App\Administration\Fixture\OperatorFixture;
use App\Common\Fixture\AbstractFixture;
use App\Scheduling\Entity\Line;
use App\Scheduling\Entity\{Train};
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

final class LineFixture extends AbstractFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        /** @var Operator $deutscheBahnOperator */
        $deutscheBahnOperator = $this->getReference('00000000-0000-0001-0000-000000000000');

        $s1Line = new Line(Uuid::fromString('00000000-0000-0002-0000-000000000000'));
        $s1Line
            ->setName('S1')
            ->setOperator($deutscheBahnOperator)
        ;

        $s8Line = new Line(Uuid::fromString('00000000-0000-0002-0000-000000000001'));
        $s8Line
            ->setName('S8')
            ->setOperator($deutscheBahnOperator)
        ;

        $manager->persist($s1Line);
        $manager->persist($s8Line);
        $manager->flush();

        $this->addEntityReference($s1Line);
        $this->addEntityReference($s8Line);
    }

    public function getDependencies(): array
    {
        return [OperatorFixture::class];
    }
}
