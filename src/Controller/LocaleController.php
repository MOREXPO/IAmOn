<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\LocaleSwitcher;

class LocaleController extends AbstractController
{
    #[Route('/change-locale', name: 'app_locale')]
    public function changeLocale(Request $request,LocaleSwitcher $localeSwitcher)
    {
        $newLocale = $request->query->get('locale', 'en'); // Obtiene el nuevo idioma de los parámetros GET
        $localeSwitcher->setLocale($newLocale);

        // Redirige al usuario a la página anterior (o una página predeterminada)
        return $this->redirect($request->headers->get('referer') ?? $this->generateUrl('default_route'));
    }
}
