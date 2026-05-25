<?php

declare(strict_types=1);

namespace App\DTO;

final readonly class Category
{
    public function __construct(private string $name)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }
}
