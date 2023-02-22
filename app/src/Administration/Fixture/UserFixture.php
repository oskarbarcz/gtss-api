<?php

declare(strict_types=1);

namespace App\Administration\Fixture;

use App\Administration\Entity\User;
use App\Common\Fixture\AbstractFixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Uid\Uuid;

class UserFixture extends AbstractFixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User(Uuid::fromString('00000000-0000-0001-0000-000000000000'));
        $user->setName('Test Dummy');
        $user->setEmail('test@test.com');

        $plaintextPassword = 'password';

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);

        $manager->persist($user);
        $manager->flush();
    }
}
