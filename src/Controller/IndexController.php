<?php

namespace App\Controller;

use App\Repository\SwitchesRepository;
use App\Repository\UserRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(SwitchesRepository $switchesRepository, UserRepository $userRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');
        $mis_switches = $switchesRepository->findBy([
            "owner" => $this->getUser()
        ]);
        $subscribed_switches = $this->getUser()->getSuscriptions();
        $subscribed_switches_aux = [];
        foreach ($subscribed_switches as $switch) {
            $subscribed_switches_aux[] = $switch->getSwitch()->toJson();
        }
        $subscribed_switches = $subscribed_switches_aux;
        $mis_switches_aux = [];
        foreach ($mis_switches as $switch) {
            $mis_switches_aux[] = $switch->toJson();
        }
        $mis_switches = $mis_switches_aux;

        return $this->render(
            'index/index.html.twig',
            [
                'mis_switches' => $mis_switches,
                'subscribed_switches' => $subscribed_switches,
            ]
        );
    }
}
