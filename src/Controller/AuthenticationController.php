<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;

class AuthenticationController extends AbstractController
{
    public function register(Request $request)
    {
        // Create a new user object for the form
        $user = new User();
        // Use the user object to build the form
        $form = $this->createFormBuilder($user)
            ->add('email', EmailType::class, array('attr' => array('class' => 'form-control mb-3', 'placeholder' => 'Your email address')))
            ->add('password', PasswordType::class, array('attr' => array('class' => 'form-control mb-3', 'placeholder' => 'Your password')))
            ->add('save', SubmitType::class, array(
                'attr' => array('class' => 'btn btn-success'),
                'label' => 'Sign Up',
            ))->getForm();

        // Handle the request to check if the form has been submitted.
        $form->handleRequest($request);

        // If the form has been submitted and is valid.
        if ($form->isSubmitted() && $form->isValid()) {
            $newUser = $form->getData();

            // Check to see if the email is already registered.
            $existingUser = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $newUser->getEmail()]);

            // If not null then, the user already exists
            if (!is_null($existingUser)) {
                $form->get('email')->addError(new FormError('Email already taken'));
            } else {
                // Encode user's password
                $hashedPassword = password_hash($newUser->getPassword(), PASSWORD_DEFAULT);
                
                // Update new user's password with encrypted password
                $newUser->setPassword($hashedPassword);
                // Add user to the database
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($newUser);
                $entityManager->flush();

                // Redirect to the show events page.
                return $this->redirectToRoute('show-events');
            }

        }

        // If the form hasn't been submitted, show the form.
        return $this->render('authentication/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
