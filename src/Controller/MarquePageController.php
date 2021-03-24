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
     * @Route("/marque/page", name="marque_page")
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
}
