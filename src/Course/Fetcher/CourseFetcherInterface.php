<?php

declare(strict_types=1);

namespace App\Course\Fetcher;

use App\DTO\CourseRequest;
use App\Entity\Course;

interface CourseFetcherInterface
{
    /** @return Course[] */
    public function fetchAllCourses(): array;

    public function fetchCourse(CourseRequest $identifier): ?Course;
}
