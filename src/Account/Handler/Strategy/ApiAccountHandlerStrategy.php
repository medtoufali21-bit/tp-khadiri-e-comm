<?php

declare(strict_types=1);

namespace App\Account\Handler\Strategy;

use App\Entity\User;

final class ApiAccountHandlerStrategy implements AccountHandlerStrategyInterface
{
    public function handle(User $user): void
    {
        throw new \LogicException('API account strategy demo: choose it explicitly only after configuration.');
    }
}
