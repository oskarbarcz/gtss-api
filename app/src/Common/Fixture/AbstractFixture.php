<?php

declare(strict_types=1);

namespace App\Common\Fixture;

use App\Common\Entity\UuidAwareEntityInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

abstract class AbstractFixture extends Fixture
{
    protected function addEntityReference(UuidAwareEntityInterface $entity): void
    {
        $this->addReference($entity->getId()->toRfc4122(), $entity);
    }
}
