<?php

namespace App\Controller;

use App\Repository\PinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PinController extends AbstractController
{
    #[Route('/', name: 'app_pin_home')]
    public function index(PinRepository $pinRepository): Response
    {
        $pins = $pinRepository->findAll();
        return $this->render('pin/index.html.twig', compact('pins'));
    }
}
