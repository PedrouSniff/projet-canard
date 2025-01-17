<?php

namespace App\Controller;

use App\Entity\Canard;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class DetailsController extends AbstractController
{
    #[Route('/details/{id}', name: 'app_details')]
    public function index(Canard $canard): Response
    {
        return $this->render('details/details.html.twig', [
            'canard'=> $canard,
        ]);
    }
}
