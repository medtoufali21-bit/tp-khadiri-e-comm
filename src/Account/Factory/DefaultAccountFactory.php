<?php

declare(strict_types=1);

namespace App\Account\Factory;

use App\DTO\RegistrationRequest;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final readonly class DefaultAccountFactory
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function create(RegistrationRequest $request): User
    {
        $user = (new User())
            ->setEmail((string) $request->getEmail())
            ->setFullName((string) $request->getFullName())
            ->setPhone((string) $request->getPhone());

        return $user->setPassword($this->passwordHasher->hashPassword($user, (string) $request->getPassword()));
    }
}
