<?php

namespace App\Administration\Fixture;

use App\Administration\Entity\Operator;
use App\Common\Fixture\AbstractFixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

final class OperatorFixture extends AbstractFixture
{
    public function load(ObjectManager $manager): void
    {
        $deutscheBahnOperator = new Operator(Uuid::fromString('00000000-0000-0001-0000-000000000000'));
        $deutscheBahnOperator
            ->setName('Deutsche Bahn')
            ->setImage('db.png')
        ;

        $odegOperator = new Operator(Uuid::fromString('00000000-0000-0001-0000-000000000001'));
        $odegOperator
            ->setName('ODEG')
            ->setImage('odeg.png')
        ;

        $manager->persist($deutscheBahnOperator);
        $manager->persist($odegOperator);
        $manager->flush();

        $this->addEntityReference($deutscheBahnOperator);
        $this->addEntityReference($odegOperator);
    }
}
