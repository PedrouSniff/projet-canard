<?php

namespace App\Controller;

use App\Repository\CanardRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CanardRepository $canardRepository): Response
    {
        $derniersCanards = $canardRepository->findBy([], ['id' => 'DESC'], 4);

        return $this->render('home/index.html.twig', [
            'canards' => $derniersCanards,
        ]);
    }
}
