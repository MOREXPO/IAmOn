<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'app_registration')]
    public function index(UserPasswordHasherInterface $passwordHasher): Response
    {
        /*// ... e.g. get the user data from a registration form
        $user = new User(...);
        $plaintextPassword = ...;

        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);

        // ...*/
        return $this->render('registration/index.html.twig', []);
    }

    #[Route('/registroUsuario', name: 'registro_usuario', methods: ['POST'])]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher,EntityManagerInterface $entityManager): Response
    {
        // Crear una nueva instancia de la entidad User
        $user = new User();

        // Crear el formulario de registro
        $form = $this->createForm(RegistrationFormType::class, $user);

        // Procesar el formulario cuando se envía
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // hash the password (based on the security.yaml config for the $user class)
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $form->get('password')->getData()
            );
            $user->setPassword($hashedPassword);

            // Guardar el usuario en la base de datos
            $entityManager->persist($user);
            $entityManager->flush();

            // Redirigir a la página de inicio o cualquier otra página deseada después del registro
            return $this->redirectToRoute('app_index');
        }

        return $this->render('registration/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
