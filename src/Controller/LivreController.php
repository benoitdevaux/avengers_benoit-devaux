<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Entity\Livre;
use PhpParser\Node\Scalar\MagicConst\Line;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
* @Route("/livre", requirements={"_locale": "en|es|fr"}, name="livre_")
*/

class LivreController extends AbstractController
{
    /**
    * @Route("/", name="index")
    */
    public function index(): Response
    {
        $livres = $this->getDoctrine()
        ->getRepository(Livre::class)
        ->findAll();
        
        return $this->render('livre/index.html.twig', [
            'livres' => $livres,
            ]);
        }
        
        /**
        * @Route("/detail/{id<\d+>?1}", name="detail")
        */
        public function displayDetail($id) : Response
        {
            $livre = $this->getDoctrine()
            ->getRepository(Livre::class)
            ->find($id);
            
            return $this->render('livre/display_detail.html.twig', [
                'id' => $livre->getId(),
                'titre' => $livre->getTitre(),
                'anneeParution' => $livre->getAnneeParution(),
                'nbrePages' => $livre->getNbrePage(),
                'auteurNom' => $livre->getAuteur()->getNom(),
                'auteurPrenom' => $livre->getAuteur()->getPrenom()
                ]);
            }
        }
        