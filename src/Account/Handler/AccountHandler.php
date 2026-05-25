<?php

declare(strict_types=1);

namespace App\Account\Handler;

use App\Account\Handler\Strategy\AccountHandlerStrategyInterface;
use App\Entity\User;

final readonly class AccountHandler
{
    public function __construct(private AccountHandlerStrategyInterface $strategy)
    {
    }

    public function handle(User $user): void
    {
        $this->strategy->handle($user);
    }
}
