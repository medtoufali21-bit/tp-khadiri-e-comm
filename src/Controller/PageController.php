<?php

declare(strict_types=1);

namespace App\Controller;

use App\Course\Handler\DefaultCourseHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PageController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(DefaultCourseHandler $courseHandler): Response
    {
        return $this->render('page/index.html.twig', [
            'courses' => \array_slice($courseHandler->fetchAllCourses(), 0, 3, true),
        ]);
    }
}
