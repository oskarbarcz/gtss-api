<?php

declare(strict_types=1);

namespace App\Common\Entity;

use Symfony\Component\Uid\Uuid;

interface UuidAwareEntityInterface
{
    public function getId(): Uuid;
}
