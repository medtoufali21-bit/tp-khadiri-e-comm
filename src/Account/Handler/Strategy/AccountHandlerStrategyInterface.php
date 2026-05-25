<?php

declare(strict_types=1);

namespace App\Account\Handler\Strategy;

use App\Entity\User;

interface AccountHandlerStrategyInterface
{
    public function handle(User $user): void;
}
