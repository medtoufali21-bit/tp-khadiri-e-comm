<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(Request $request): Response
    {
        $cart = $request->getSession()->get('cart', []);
        $total = \array_reduce($cart, static fn (float $sum, array $item): float => $sum + ($item['price'] * $item['quantity']), 0.0);

        return $this->render('cart/index.html.twig', [
            'cart' => $cart,
            'total' => $total,
        ]);
    }

    #[Route('/cart/clear', name: 'app_cart_clear')]
    public function clear(Request $request): Response
    {
        $request->getSession()->remove('cart');
        $this->addFlash('success', 'Panier vide.');

        return $this->redirectToRoute('app_cart');
    }
}
