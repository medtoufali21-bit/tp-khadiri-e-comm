<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\Type\CreditCardType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CheckoutController extends AbstractController
{
    #[Route('/checkout', name: 'app_checkout')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(CreditCardType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $request->getSession()->remove('cart');
            $this->addFlash('success', 'Paiement simule avec succes.');

            return $this->redirectToRoute('app_home');
        }

        return $this->render('checkout/index.html.twig', ['form' => $form]);
    }
}
