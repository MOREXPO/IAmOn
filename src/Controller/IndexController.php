<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render(
            'index/index.html.twig',
            []
        );
    }

    #[Route('/switches', name: 'app_switches')]
    public function switch(): Response
    {
        return $this->render(
            'index/switches.html.twig',
            []
        );
    }
}
