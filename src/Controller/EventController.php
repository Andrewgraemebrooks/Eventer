<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;
use \App\Entity\Event;

class EventController extends AbstractController
{
    /**
     * The route to take the user to the home page.
     *
     * @return void
     */
    public function index()
    {
        // Render the home page.
        return $this->render('event/index.html.twig');
    }

    /**
     * The route to take the user to all the events.
     *
     * @return void
     */
    public function show(Security $security)
    {
        $currentUser = $security->getUser();
        // Get all of the user's events.
        $events = $this->getDoctrine()->getRepository(Event::class)->findBy(['user' => $currentUser]);

        // Render the page to display all of the events.
        return $this->render('event/show.html.twig', array('events' => $events));
    }

    /**
     * The route to take the user to the create a new event. It is also deals with the submission of the event's form.
     *
     * @param Request $request - The request object.
     * @return void
     */
    public function new(Request $request, Security $security)
    {
        // Create a new event object.
        $event = new Event();
        // Use the event object to build a form.
        $form = $this->createFormBuilder($event)
            ->add('name', TextType::class, array('attr' =>
                array('class' => 'form-control mb-3', 'placeholder' => 'The Event Name')))
            ->add('description', TextType::class, array('attr' =>
                array('class' => 'form-control mb-3', 'placeholder' => 'A Description Of The Event')))
            ->add('date', DateTimeType::class, array('attr' =>
                array('class' => 'form-control input-group date mb-3')))
            ->add('duration', NumberType::class, array('attr' =>
                array('class' => 'form-control mb-3', 'placeholder' => 'The Duration (In Minutes)')))
            ->add('venue', TextType::class, array('attr' =>
                array('class' => 'form-control mb-3', 'placeholder' => 'The Location Of The Event')))
            ->add('save', SubmitType::class, array(
                'attr' => array('class' => 'btn btn-success'),
                'label' => 'Create',
            ))->getForm();

        // Handle the request to check if the form has been submitted.
        $form->handleRequest($request);

        // If the form has been submitted and is valid, add the event to the database.
        if ($form->isSubmitted() && $form->isValid()) {
            $event = $form->getData();

            $event->setUser($security->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();

            // Redirect to the show events page.
            return $this->redirectToRoute('show-events');
        }

        // If the form hasn't been submitted, show the form.
        return $this->render('event/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * The route to take the user to the edit event page. It is also deals with the submission of the event's form.
     *
     * @param Request $request
     * @param String $id
     * @return void
     */
    public function edit(Request $request, $id)
    {
        // Find the specific event.
        $event = $this->getDoctrine()->getRepository(Event::class)->find($id);
        // Use the event object to build a form so that all of the current information is shown.
        $form = $this->createFormBuilder($event)
            ->add('name', TextType::class, array('attr' =>
                array('class' => 'form-control mb-3', 'placeholder' => 'The Event Name')))
            ->add('description', TextType::class, array('attr' =>
                array('class' => 'form-control mb-3', 'placeholder' => 'A Description Of The Event')))
            ->add('date', DateTimeType::class, array('attr' =>
                array('class' => 'form-control input-group date mb-3')))
            ->add('duration', NumberType::class, array('attr' =>
                array('class' => 'form-control mb-3', 'placeholder' => 'The Duration (In Minutes)')))
            ->add('venue', TextType::class, array('attr' =>
                array('class' => 'form-control mb-3', 'placeholder' => 'The Location Of The Event')))
            ->add('save', SubmitType::class, array(
                'attr' => array('class' => 'btn btn-success'),
                'label' => 'Update',
            ))->getForm();

        // Handle the request to check if the form has been submitted.
        $form->handleRequest($request);
        // If the form has been submitted and is valid, update the event in the database.
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            // Redirect to the show events page.
            return $this->redirectToRoute('show-events');
        }

        // If the form hasn't been submitted, show the form.
        return $this->render('event/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * The route to delete an event.
     *
     * @param String $id
     * @return void
     */
    public function delete($id)
    {
        // Find the specific event.
        $event = $this->getDoctrine()->getRepository(Event::class)->find($id);

        // Remove the event from the database.
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($event);
        $entityManager->flush();

        // Return an empty response. The front-end javascript automatically reloads the page.
        $response = new Response();
        return $response->send();
    }
}
