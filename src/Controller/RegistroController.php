<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class RegistroController extends AbstractController
{
    #[Route('/registro', name: 'registro')]
    public function index(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($passwordHasher->hashPassword($user,$form['password']->getData()));
            $em->persist($user);
            $em->flush();
            $this->addFlash('exito', User::REGISTRO_EXITOSO);
            return $this->redirectToRoute('registro');
        }
        return $this->render('registro/index.html.twig', [
            'controller_name' => 'Hola Mundo',
            'formulario' =>$form->createView()
        ]);
    }
}