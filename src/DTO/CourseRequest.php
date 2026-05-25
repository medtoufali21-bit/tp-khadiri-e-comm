<?php

declare(strict_types=1);

namespace App\DTO;

final readonly class CourseRequest
{
    public function __construct(private int $identifier)
    {
    }

    public function getIdentifier(): int
    {
        return $this->identifier;
    }
}
