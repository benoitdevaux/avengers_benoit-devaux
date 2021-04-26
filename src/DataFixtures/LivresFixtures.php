<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Auteur;
use App\Entity\Livre;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr\Math;

class LivresFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $auteurUn = new Auteur();
        $auteurUn->setNom('Kant');
        $auteurUn->setPrenom('Emmanuel');
        $auteurs[] = $auteurUn;
        $manager->persist($auteurUn);

        $auteurDeux = new Auteur();
        $auteurDeux->setNom('Tolkien');
        $auteurDeux->setPrenom('John Ronald');
        $auteurs[] = $auteurDeux;
        $manager->persist($auteurDeux);
        
        $auteurTrois = new Auteur();
        $auteurTrois->setNom('Kant');
        $auteurTrois->setPrenom('Emmanuel');
        $auteurs[] = $auteurTrois;
        $manager->persist($auteurTrois);

        $auteurQuatre = new Auteur();
        $auteurQuatre->setNom('Friederich');
        $auteurQuatre->setPrenom('Nietzsche');
        $auteurs[] = $auteurQuatre;
        $manager->persist($auteurQuatre);
        
 
        for ($i = 0; $i < 15; $i++) {
            $livre = new Livre();
            $livre->setTitre('Livre '.$i);
            $livre->setAnneeParution(mt_rand(1975, 2020));
            $livre->setNbrePage(mt_rand(45, 1500));
            $livre->setAuteur($auteurs[mt_rand(0, 3)]);
            $manager->persist($livre);
        }
        $manager->flush();
    }
}
