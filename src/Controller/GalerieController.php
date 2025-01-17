<?php

namespace App\Controller;

use App\Entity\Canard;
use App\Form\CanardType;
use App\Repository\CanardRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class GalerieController extends AbstractController
{
    #[Route('/galerie', name: 'app_galerie')]
    public function ajouter(Request $request, EntityManagerInterface $entityManager, CanardRepository $repository): Response
    {
        $canard = new Canard(); // Création d'un nouvel objet Canard

        $galerie = $repository->findAll();
    
        // Création du formulaire en indiquant l'objet sur lequel le formulaire va travailler
        $form = $this->createForm(CanardType::class, $canard);
    
        // Indique à Symfony de prendre les données et de les associer au formulaire
        $form->handleRequest($request);

        $get = $this->getUser(); 
    
        // Vérification si le formulaire est soumis et qu'il est valide
        if ($form->isSubmitted() && $form->isValid()) {

            $canard->setUser($get);

            $entityManager->persist($get);

            // On marque les informations de l'objet pizza prêt à être envoyé en bdd
            $entityManager->persist($canard);
    
            // On envoie les données
            $entityManager->flush();
    
            // Message de succès
            $this->addFlash('success', 'Pizza ajouté avec succès !');
    
            // Redirection
            return $this->redirectToRoute('app_home');
        }
        return $this->render('galerie/galerie.html.twig', [
            'canardform' => $form->createView(),
            'galerie' => $galerie,
        ]);
    }
}
