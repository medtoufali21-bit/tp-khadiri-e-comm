<?php

declare(strict_types=1);

namespace App\DTO;

final readonly class Course
{
    public function __construct(
        private string $name,
        private float $price,
        private string $synopsis,
        private string $description,
        private Author $author,
        private Category $category,
        private string $imagePath = 'images/courses/programming.png',
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getSynopsis(): string
    {
        return $this->synopsis;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getImagePath(): string
    {
        return $this->imagePath;
    }
}
