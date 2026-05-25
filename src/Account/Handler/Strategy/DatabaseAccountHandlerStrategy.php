<?php

declare(strict_types=1);

namespace App\Account\Handler\Strategy;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

final readonly class DatabaseAccountHandlerStrategy implements AccountHandlerStrategyInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function handle(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
