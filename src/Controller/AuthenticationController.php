<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthenticationController extends AbstractController
{
    /**
     * The route to register the user to the database.
     *
     * @param Request $request - The request object.
     * @return void
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        // Create a new user object for the form
        $user = new User();
        // Use the user object to build the form
        $form = $this->createFormBuilder($user)
            ->add('email', EmailType::class, array('attr' =>
                array('class' => 'form-control mb-3', 'placeholder' => 'Your email address')))
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Password', 'attr' =>
                    array('class' => 'form-control mb-3', 'placeholder' => 'Your password')],
                'second_options' => ['label' => 'Confirm Password', 'attr' =>
                    array('class' => 'form-control mb-3', 'placeholder' => 'Confirm password')]))
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
            $existingUser = $this->getDoctrine()->getRepository(User::class)
            ->findOneBy(['email' => $newUser->getEmail()]);
            
            // If not null then, the user already exists
            if (!is_null($existingUser)) {
                $form->get('email')->addError(new FormError('Email already taken'));
            } else {
                // Encode the user's password
                $newUser->setPassword($encoder->encodePassword($newUser, $newUser->getPassword()));

                // Add user to the database
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($newUser);
                $entityManager->flush();

                // Redirect to the show events page.
                return $this->redirectToRoute('app_login');
            }
        }

        // If the form hasn't been submitted, show the form.
        return $this->render('authentication/register.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'authentication/login.html.twig',
            ['last_username' => $lastUsername, 'error' => $error]
        );
    }

    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted 
            by the logout key on your firewall.');
    }
}
