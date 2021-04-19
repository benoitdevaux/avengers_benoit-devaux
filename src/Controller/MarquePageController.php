<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\MarquePage;
use App\Entity\MotsCles;
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
            $motCleUn = new MotsCles();
            $motCleUn->setLibelle('MVC');

            $motCleDeux = new MotsCles();
            $motCleDeux->setLibelle('Symfony');

            $motCleTrois = new MotsCles();
            $motCleTrois->setLibelle('PHP');


            $marquePage = new MarquePage();
            $marquePage->setUrl("https://symfony.com");
            $marquePage->setDateCreation(new \DateTime());
            $marquePage->setCommentaire("Vers le site de Symfony");
            $marquePage->addMotsCle($motCleUn);
            $marquePage->addMotsCle($motCleDeux);
            $marquePage->addMotsCle($motCleTrois);
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($motCleUn);
            $entityManager->persist($motCleDeux);
            $entityManager->persist($motCleTrois);
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
                'commentaire' => $marquePage->getCommentaire(),
                'motsCles' => $marquePage->getMotsCles()
                ]);
            }
            
        }
        