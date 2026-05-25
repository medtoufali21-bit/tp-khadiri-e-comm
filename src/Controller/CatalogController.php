<?php

declare(strict_types=1);

namespace App\Controller;

use App\Course\Handler\DefaultCourseHandler;
use App\DTO\Course;
use App\Form\Type\AddToCartType;
use App\Form\Type\AddToWishlistType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/catalog', name: 'app_catalog_')]
final class CatalogController extends AbstractController
{
    public function __construct(private readonly DefaultCourseHandler $courseHandler)
    {
    }

    #[Route(path: '/all', name: 'all', priority: 1)]
    public function all(): Response
    {
        return $this->render('catalog/index.html.twig', [
            'courses' => $this->courseHandler->fetchAllCourses(),
        ]);
    }

    #[Route(path: '/{slug}', name: 'view')]
    public function show(string $slug, Request $request): Response
    {
        $course = $this->courseHandler->getCourseBySlug($slug);
        if (!$course instanceof Course) {
            throw $this->createNotFoundException('La page que vous demandez est introuvable.');
        }

        $wishlistForm = $this->createForm(AddToWishlistType::class);
        $cartForm = $this->createForm(AddToCartType::class);
        $wishlistForm->handleRequest($request);
        $cartForm->handleRequest($request);

        if ($wishlistForm->isSubmitted() && $wishlistForm->isValid()) {
            $wishlist = $request->getSession()->get('wishlist', []);
            $wishlist[$slug] = $course->getName();
            $request->getSession()->set('wishlist', $wishlist);
            $this->addFlash('success', 'Cours ajoute a la wishlist.');

            return $this->redirectToRoute('app_catalog_view', ['slug' => $slug]);
        }

        if ($cartForm->isSubmitted() && $cartForm->isValid()) {
            $cart = $request->getSession()->get('cart', []);
            $cart[$slug] = [
                'name' => $course->getName(),
                'price' => $course->getPrice(),
                'quantity' => (int) $cartForm->get('quantity')->getData(),
                'format' => $cartForm->get('format')->getData(),
            ];
            $request->getSession()->set('cart', $cart);
            $this->addFlash('success', 'Cours ajoute au panier.');

            return $this->redirectToRoute('app_cart');
        }

        return $this->render('catalog/show.html.twig', [
            'course' => $course,
            'slug' => $slug,
            'wishlistForm' => $wishlistForm,
            'cartForm' => $cartForm,
        ]);
    }

    public function similarCourses(string $slug, int $limit = 2): Response
    {
        $course = $this->courseHandler->getCourseBySlug($slug);

        return $this->render('catalog/similar_courses.html.twig', [
            'courses' => $course instanceof Course ? $this->courseHandler->getSimilarCourses($course, $limit) : [],
        ]);
    }
}
