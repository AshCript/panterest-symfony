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

    #[Route('/pin/{id<[0-9]+>}', name: 'app_pin_show')]
    public function show(int $id, PinRepository $pinRepository): Response
    {
        $pin = $pinRepository->find($id);
        if(!$pin){
            throw $this->createNotFoundException("Pin with id $id doesn't exist.");
        }
        return $this->render('pin/show.html.twig', compact('pin'));
    }
}