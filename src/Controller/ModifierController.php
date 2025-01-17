<?php

namespace App\Controller;

use App\Entity\Canard;
use App\Form\CanardType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ModifierController extends AbstractController
{
    #[Route('/modifier/canard{id}', name: 'app_modifier')]
    public function modifier(Canard $canard, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Création du formulaire en indiquant l'objet sur lequel le formulaire va travailler
        $form = $this->createForm(CanardType::class, $canard);

        // Indique à Symfony de prendre les données et de les associer au formulaire
        $form->handleRequest($request);

        // Vérification si le formulaire est soumis et qu'il est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // On marque les informations de l'objet canard prêt à être envoyé en base de données
            $entityManager->persist($canard);
            // On envoie les données
            $entityManager->flush();

            // Message de succès
            $this->addFlash('success', 'La pizza ajouté avec succès !');

            // Redirection
            return $this->redirectToRoute('app_galerie');
        }

        return $this->render('modifier/modifier.html.twig', [
            'canardform'=>$form->createView(),   
        ]);
    }
}
