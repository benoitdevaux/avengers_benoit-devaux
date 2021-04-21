<?php

namespace App\Controller;

use App\Entity\Faune;
use App\Entity\Flore;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
* @Route("/caillou", requirements={"_locale": "en|es|fr"}, name="caillou_")
*/

class CaillouController extends AbstractController
{
    /**
    * @Route("/faune", name="faune")
    */
    public function indexFaune(): Response
    {
        $faunes = $this->getDoctrine()
        ->getRepository(Faune::class)
        ->findAll();
        
        return $this->render('caillou/faune/index.html.twig', [
            'faunes' => $faunes
            ]);
        }
        
        /**
        * @Route("/flore", name="flore")
        */
        public function indexFlore(): Response
        {
            $flores = $this->getDoctrine()
            ->getRepository(Flore::class)
            ->findAll();
            
            return $this->render('caillou/flore/index.html.twig', [
                'flores' => $flores
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
            