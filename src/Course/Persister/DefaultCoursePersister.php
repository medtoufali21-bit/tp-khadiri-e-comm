<?php

declare(strict_types=1);

namespace App\Course\Persister;

use App\Entity\Course;
use Doctrine\ORM\EntityManagerInterface;

final readonly class DefaultCoursePersister implements CoursePersisterInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function save(Course $course, bool $isNewEntry = false): void
    {
        if ($isNewEntry) {
            $this->entityManager->persist($course);
        }

        $this->entityManager->flush();
    }
}
