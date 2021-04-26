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
        * @Route("/detail/{id<\d+>?1}", name="detail")
        */
        public function displayDetail($id) : Response
        {
            $marquePage = $this->getDoctrine()
            ->getRepository(MarquePage::class)
            ->find($id);
            
            return $this->render('livre/display_detail.html.twig', [
                'id' => $marquePage->getId(),
                'url' => $marquePage->getUrl(),
                'dateCreation' => $marquePage->getDateCreation()->format('Y-m-d'),
                'commentaire' => $marquePage->getCommentaire(),
                'motsCles' => $marquePage->getMotsCles()
                ]);
            }
            
        }
        