<?php

declare(strict_types=1);

namespace App\Course\Handler;

use App\Course\Factory\DefaultCourseFactory;
use App\DTO\Course;

final readonly class DefaultCourseHandler implements SimilarCourseProviderInterface
{
    public function __construct(private DefaultCourseFactory $factory)
    {
    }

    public function fetchAllCourses(): array
    {
        return [
            'introduction-a-la-programmation' => $this->factory->create([
                'name' => 'Introduction a la programmation',
                'price' => 49.99,
                'synopsis' => 'Apprenez les bases de la programmation avec Python.',
                'description' => 'Ce cours couvre les variables, les conditions, les boucles, les fonctions et les structures de donnees.',
                'author' => 'Alice Dupont',
                'category' => 'Informatique',
                'imagePath' => 'images/courses/programming.png',
            ]),
            'analyse-financiere' => $this->factory->create([
                'name' => 'Analyse financiere',
                'price' => 79.00,
                'synopsis' => 'Comprendre les etats financiers et les indicateurs cles.',
                'description' => 'Ce cours guide les etudiants dans la lecture des bilans, comptes de resultat et flux de tresorerie.',
                'author' => 'Jean Martin',
                'category' => 'Finance',
                'imagePath' => 'images/courses/finance.png',
            ]),
            'photographie-numerique' => $this->factory->create([
                'name' => 'Photographie numerique',
                'price' => 59.50,
                'synopsis' => 'Maitrisez votre appareil photo et composez des images percutantes.',
                'description' => 'Apprenez les techniques de prise de vue, de composition et de retouche photo avec des outils professionnels.',
                'author' => 'Sophie Bernard',
                'category' => 'Arts visuels',
                'imagePath' => 'images/courses/photography.png',
            ]),
            'marketing-digital' => $this->factory->create([
                'name' => 'Marketing digital',
                'price' => 69.00,
                'synopsis' => 'Construire une strategie digitale orientee conversion.',
                'description' => 'SEO, reseaux sociaux, campagnes sponsorisees et tableaux de bord pour piloter une boutique en ligne.',
                'author' => 'Nadia El Amrani',
                'category' => 'Business',
                'imagePath' => 'images/courses/marketing.png',
            ]),
        ];
    }

    public function getCourseBySlug(string $slug): ?Course
    {
        $courses = $this->fetchAllCourses();

        return $courses[$slug] ?? null;
    }

    public function getSimilarCourses(Course $course, int $limit): array
    {
        $courses = \array_filter(
            $this->fetchAllCourses(),
            static fn (Course $item): bool => $item->getName() !== $course->getName(),
        );

        return \array_slice($courses, 0, $limit, true);
    }
}
