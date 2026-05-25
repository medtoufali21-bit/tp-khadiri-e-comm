<?php

declare(strict_types=1);

namespace App\Controller;

use App\Course\Fetcher\CourseFetcherInterface;
use App\Course\Persister\CoursePersisterInterface;
use App\DTO\CourseRequest;
use App\Entity\Course;
use App\File\Handler\FileHandler;
use App\File\Uploader\FileUploaderInterface;
use App\Form\Type\CourseType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

final class CourseController extends AbstractController
{
    public function __construct(private readonly CourseFetcherInterface $courseFetcher)
    {
    }

    #[Route('/course', name: 'app_course')]
    public function index(Request $request, FileHandler $fileHandler, FileUploaderInterface $fileUploader, CoursePersisterInterface $persister): Response
    {
        $course = new Course();
        $form = $this->createForm(CourseType::class, $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('file')->getData();
            if (null !== $file) {
                $course->setFilePath($fileHandler->handle($file, $fileUploader));
            }
            $persister->save($course, true);
            $this->addFlash('success', 'Cours ajoute dans la bibliotheque.');

            return $this->redirectToRoute('app_course_all');
        }

        return $this->render('course/index.html.twig', ['form' => $form]);
    }

    #[Route('/courses/all', name: 'app_course_all', priority: 1)]
    public function all(): Response
    {
        return $this->render('course/all.html.twig', [
            'list' => $this->courseFetcher->fetchAllCourses(),
        ]);
    }

    #[Route('/courses/{identifier}', name: 'app_course_show')]
    public function show(string $identifier): Response
    {
        $course = $this->courseFetcher->fetchCourse(new CourseRequest((int) $identifier));
        if (!$course instanceof Course) {
            throw new NotFoundHttpException('Page not found');
        }

        return $this->render('course/show.html.twig', ['course' => $course]);
    }
}
