<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SwitchController extends AbstractController
{
    #[Route('/switch', name: 'app_switch')]
    public function index(): Response
    {
        return $this->render('switch/index.html.twig', [
            'controller_name' => 'SwitchController',
        ]);
    }
}
