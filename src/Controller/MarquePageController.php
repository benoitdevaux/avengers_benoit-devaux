<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\MarquePage;
use Doctrine\ORM\EntityManagerInterface;

class MarquePageController extends AbstractController
{
    /**
    * @Route("/marque_page", name="marque_page")
    */
    public function index(): Response
    {
        $marquePages = $this->getDoctrine()
        ->getRepository(MarquePage::class)
        ->findAll();
        
        return $this->render('marque_page/index.html.twig', [
            'marquePages' => $marquePages,
            ]);
    }
        
    /**
    * @Route("/marque_page/ajouter", name="add_marque_page")
    */
    public function ajouterMarquePage(): Response
    {
        $marquePage = new MarquePage();
        $marquePage->setUrl("https://symfony.com");
        $marquePage->setDateCreation(new \DateTime());
        $marquePage->setCommentaire("Vers le site de Symfony");
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($marquePage);
        $entityManager->flush();
        
        return new Response("Marque page enregistré avec l'id ".$marquePage->getId());
    }
        
}
    