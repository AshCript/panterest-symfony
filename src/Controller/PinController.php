<?php

namespace App\Controller;

use App\Entity\Pin;
use App\Form\PinType;
use App\Repository\PinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PinController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(PinRepository $pinRepository): Response
    {
        $pins = $pinRepository->findBy([], ['createdAt' => 'DESC']);
        return $this->render('pin/index.html.twig', compact('pins'));
    }

    #[Route('/pin/{id<[0-9]+>}', name: 'app_pin_show', methods: ['GET'])]
    public function show(Pin $pin, $id): Response
    {
        return $this->render('pin/show.html.twig', compact('pin'));
    }

    #[Route('/pin/create', name: 'app_pin_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $pin = new Pin();
        $pinForm = $this->createForm(PinType::class, $pin);

        $pinForm->handleRequest($request); // It set method to POST if the form is sent, else method is GET

        // If POST method found
        if($pinForm->isSubmitted() && $pinForm->isValid()){
            $em->persist($pin);
            $em->flush();
            return $this->redirectToRoute('app_pin_show', [
                'id' => $pin->getId()
            ]);
        }
        // End POST method


        // Else (by default : GET gethod)
        return $this->render('pin/create.html.twig', [
            'pinForm' => $pinForm->createView()
        ]);
    }

    #[Route('/pin/edit/{id<[0-9]+>}', name: 'app_pin_update', methods: ['GET', 'PUT', 'POST'])] // must be GET and PUT only, but gonna edit it later.
    public function update(Pin $pin, Request $request, EntityManagerInterface $em): Response
    {
        $pinForm = $this->createForm(PinType::class, $pin, [
            'method' => 'POST' // Must be PUT but gonna edit it later.
        ]);
        $pinForm->handleRequest($request); // It set method to POST if the form is sent, else method is GET

        // If POST method found
        if($pinForm->isSubmitted() && $pinForm->isValid()){
            $em->flush();
            return $this->redirectToRoute('app_pin_show', [
                'id' => $pin->getId()
            ]);
        }
        // End POST method


        // Else (by default : GET gethod)
        return $this->render('pin/update.html.twig', [
            'pinForm' => $pinForm->createView(),
            'pin' => $pin
        ]);
    }
}