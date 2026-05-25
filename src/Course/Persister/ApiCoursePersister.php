<?php

declare(strict_types=1);

namespace App\Course\Persister;

use App\Entity\Course;

final class ApiCoursePersister implements CoursePersisterInterface
{
    public function save(Course $course, bool $isNewEntry = false): void
    {
        throw new \LogicException('API persister demo: configure this service explicitly before using it.');
    }
}
