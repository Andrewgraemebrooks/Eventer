<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \App\Entity\Event;
use Psr\Log\LoggerInterface;

class EventController extends AbstractController
{
    /**
     * @Route("/")
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
     * @Route("/event/create")
     */
    public function create()
    {

    }

    /**
     * @Route("/event/save")
     */
    public function save(LoggerInterface $logger)
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

        // $log->pushHandler(new StreamHandler(__DIR__ . '/my_app.log', Logger::DEBUG));
        // $log->pushHandler(new FirePHPHandler());

        // You can now use your logger
        $logger->info('My logger is now ready');
        $logger->debug('Event Object', ['event' => $event]);

        // Persist tells the entity manager that we want to save the $event object.
        $entityManager->persist($event);

        // Add the new event to the database.
        $entityManager->flush();

        return new Response('Saved an event with the id of ' . $event->getId());
    }
}
