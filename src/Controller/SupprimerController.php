<?php

namespace App\Controller;

use App\Entity\Canard;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SupprimerController extends AbstractController
{
    #[Route('/supprimer/canard{id}', name: 'app_supprimer')]
    public function supprimer(Canard $canard, Request $request, EntityManagerInterface $entityManager): Response
    {

        if($this->isCsrfTokenValid("SUP". $canard->getId(),$request->get('_token'))){
            $entityManager->remove($canard);
            $entityManager->flush();
            $this->addFlash("success","La suppression a été effectuée");
            return $this->redirectToRoute("app_galerie");
        }
    }
}
