<?php

declare(strict_types=1);

namespace App\Course\Factory;

use App\DTO\Author;
use App\DTO\Category;
use App\DTO\Course;

final class DefaultCourseFactory extends AbstractCourseFactory
{
    public function create(array $data): Course
    {
        return new Course(
            name: $data['name'],
            price: (float) $data['price'],
            synopsis: $data['synopsis'],
            description: $data['description'],
            author: new Author($data['author']),
            category: new Category($data['category']),
            imagePath: $data['imagePath'] ?? 'images/courses/programming.png',
        );
    }
}
