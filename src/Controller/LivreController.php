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
        * @Route("/ajouter", name="add")
        */
        
        public function ajouterLivre(): Response
        {
            $auteurUn = new Auteur();
            $auteurUn->setNom('Reuel Tolkien');
            $auteurUn->setPrenom('John Ronald');
            
            $auteurDeux = new Auteur();
            $auteurDeux->setNom('Rowling');
            $auteurDeux->setPrenom('Joanne');
            
            $livreUn = new Livre();
            $livreUn->setTitre('Le seigneur des anneaux');
            $livreUn->setAnneeParution('1954');
            $livreUn->setNbrePage('1248');
            $livreUn->setAuteur($auteurUn);
            
            $livreDeux = new Livre();
            $livreDeux->setTitre('Harry Potter');
            $livreDeux->setAnneeParution('1997');
            $livreDeux->setNbrePage('240');
            $livreDeux->setAuteur($auteurDeux);
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($auteurUn);
            $entityManager->persist($auteurDeux);
            $entityManager->persist($livreUn);
            $entityManager->persist($livreDeux);
            $entityManager->flush();
            
            return new Response("Livres enregistrés avec les id " . $livreUn->getId() . " et " . $livreDeux->getId());
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
        