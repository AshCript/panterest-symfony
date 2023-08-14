<?php

namespace App\Controller;

use App\Entity\Pin;
use App\Repository\PinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function create(): Response
    {
        $pin = new Pin();
        $pinForm = $this->createFormBuilder($pin)
                        ->add('title')
                        ->add('description')
                        ->getForm();


        return $this->render('pin/create.html.twig', [
            'pinForm' => $pinForm->createView()
        ]);
    }
}