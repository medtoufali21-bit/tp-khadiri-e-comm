<?php

declare(strict_types=1);

namespace App\Course\Fetcher;

use App\DTO\CourseRequest;
use App\Entity\Course;
use App\Repository\CourseRepository;

final readonly class DefaultCourseFetcher implements CourseFetcherInterface
{
    public function __construct(private CourseRepository $repository)
    {
    }

    public function fetchAllCourses(): array
    {
        return $this->repository->findBy([], ['createdAt' => 'DESC']);
    }

    public function fetchCourse(CourseRequest $identifier): ?Course
    {
        return $this->repository->find($identifier->getIdentifier());
    }
}
