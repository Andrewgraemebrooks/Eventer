<?php

namespace App\Controller;

// use App\Form\EventType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \App\Entity\Event;

class EventController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {

        $events = $this->getDoctrine()->getRepository(Event::class)->findAll();

        return $this->render('event/index.html.twig', array('events' => $events));

        // return $this->render('event/index.html.twig', [
        //     'controller_name' => 'EventController',
        // ]);
    }

    /**
     * @Route("/show-events", name="show-events")
     */
    public function show()
    {
        $events = $this->getDoctrine()->getRepository(Event::class)->findAll();

        return $this->render('event/show.html.twig', array('events' => $events));
    }

    /**
     * @Route("/create-event")
     */
    function new (Request $request) {
        $event = new Event();
        // $form = $this->createForm(EventType::class, $event, array('attr' => array('class' => 'form-control')));
        $form = $this->createFormBuilder($event)
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control mb-3')))
            ->add('description', TextType::class, array('attr' => array('class' => 'form-control mb-3')))
            ->add('date', DateTimeType::class, array('attr' => array('class' => 'mb-3')))
            ->add('duration', NumberType::class, array('attr' => array('class' => 'form-control mb-3')))
            ->add('venue', TextType::class, array('attr' => array('class' => 'form-control mb-3')))
            ->add('save', SubmitType::class, array(
                'attr' => array('class' => 'btn btn-success'),
                'label' => 'Create',
            ))->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $event = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute("index");
        }

        return $this->render('event/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("api/event/save")
     */
    public function save()
    {
        // Get the entity manager.
        $entityManager = $this->getDoctrine()->getManager();

        // Create the new event
        $event = new Event();
        $event->setName('Event One');
        $event->setDescription('An event');
        $event->setDate(new DateTime());
        $event->setDuration(120);
        $event->setVenue("Venue");

        // Persist tells the entity manager that we want to save the $event object.
        $entityManager->persist($event);

        // Add the new event to the database.
        $entityManager->flush();

        return new Response('Saved an event with the id of ' . $event->getId());
    }
}
