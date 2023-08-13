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
        $pins = $pinRepository->findAll();
        return $this->render('pin/index.html.twig', compact('pins'));
    }

    #[Route('/pin/{id<[0-9]+>}', name: 'app_pin_show', methods: ['GET'])]
    public function show(Pin $pin, $id): Response
    {
        return $this->render('pin/show.html.twig', compact('pin'));
    }
}