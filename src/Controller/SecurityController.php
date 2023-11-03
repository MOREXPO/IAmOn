<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Contracts\Translation\TranslatorInterface;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils,TranslatorInterface $translator): Response
    {

        if ($this->getUser()) {
            return $this->redirectToRoute("app_index");
        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error ? $error?->getMessage() : '',
        ]);
    }

    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(): never
    {
        // controller can be blank: it will never be called!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }

    #[Route('/registration', name: 'app_registration', methods: ['POST', 'GET'])]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {

        if ($this->getUser()) {
            return $this->redirectToRoute("app_index");
        }
        // Crear una nueva instancia de la entidad User
        $user = new User();

        if ($request->getMethod() == 'POST') {

            if ($request->request->get('password') !== $request->request->get('passwordRepeat'))
                return $this->render(
                    'security/registration.html.twig',
                    [
                        'error' => 'Las contraseñas tienen que coincider',
                    ]
                );
            // hash the password (based on the security.yaml config for the $user class)
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $request->get('password')
            );
            $user->setPassword($hashedPassword);
            $user->setUsername($request->get('username'));
            if (!empty($request->get('email'))) $user->setEmail($request->get('email'));
            // Guardar el usuario en la base de datos
            $entityManager->persist($user);
            $entityManager->flush();

            // Redirigir a la página de inicio o cualquier otra página deseada después del registro
            return $this->redirectToRoute('app_index');
        }


        return $this->render(
            'security/registration.html.twig',
            [
                'error' => null,
            ]
        );
    }
}
