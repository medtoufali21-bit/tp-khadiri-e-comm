<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\Type\SubscribeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SubscribeController extends AbstractController
{
    public function showForm(): Response
    {
        return $this->render('subscribe/index.html.twig', [
            'form' => $this->createForm(SubscribeType::class),
        ]);
    }

    #[Route(path: '/subscribe', name: 'app_subscribe', methods: ['POST'])]
    public function proceed(Request $request): Response
    {
        $this->addFlash('success', 'Merci pour votre inscription a la newsletter.');

        return $this->redirect($request->headers->get('referer') ?: $this->generateUrl('app_home'));
    }
}
