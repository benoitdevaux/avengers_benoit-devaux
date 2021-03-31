<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\MarquePage;
use Doctrine\ORM\EntityManagerInterface;

/**
* @Route("/marque_page", requirements={"_locale": "en|es|fr"}, name="marque_page_")
*/

class MarquePageController extends AbstractController
{  
    /**
     * @Route("/", name="index")
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
        * @Route("/ajouter", name="add")
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
        
        /**
        * @Route("/display_detail/{id<\d+>?1}", name="detail")
        */
        public function displayDetail($id) : Response
        {
            $marquePage = $this->getDoctrine()
            ->getRepository(MarquePage::class)
            ->find($id);
            
            return $this->render('marque_page/displayDetail.html.twig', [
                'id' => $marquePage->getId(),
                'url' => $marquePage->getUrl(),
                'dateCreation' => $marquePage->getDateCreation()->format('Y-m-d'),
                'commentaire' => $marquePage->getCommentaire()
                ]);
            }
            
        }
        