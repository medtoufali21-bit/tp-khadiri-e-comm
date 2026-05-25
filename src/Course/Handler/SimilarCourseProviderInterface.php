<?php

declare(strict_types=1);

namespace App\Course\Handler;

use App\DTO\Course;

interface SimilarCourseProviderInterface
{
    public function getSimilarCourses(Course $course, int $limit): array;
}
