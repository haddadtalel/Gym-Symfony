<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/user/user', name: 'app_user_user')]
    public function index(): Response
    {
        return $this->render('user/user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
