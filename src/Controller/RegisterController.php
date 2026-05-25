<?php

declare(strict_types=1);

namespace App\Controller;

use App\Account\Factory\DefaultAccountFactory;
use App\Account\Handler\AccountHandler;
use App\DTO\RegistrationRequest;
use App\Form\Type\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function index(Request $request, DefaultAccountFactory $factory, AccountHandler $handler): Response
    {
        $registration = new RegistrationRequest();
        $form = $this->createForm(RegisterType::class, $registration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $handler->handle($factory->create($registration));
            $this->addFlash('success', 'Compte cree. Vous pouvez vous connecter.');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('register/index.html.twig', ['registerForm' => $form]);
    }
}
