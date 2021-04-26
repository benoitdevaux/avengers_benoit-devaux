<?php

namespace App\DataFixtures;

use App\Entity\MarquePage;
use App\Entity\MotsCles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MarquePagesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $mots_cles = [
            "bizarres", "bouchon", "buanderie", "souverainement", "mandat",
            "masse", "notions", "location", "ordinaire", "précisément",
            "réflexion", "résultat", "manager", "zénith", "obséder",
            "nunuche", "noyé", "précise", "ravir", "séparer",
            "clown", "cocufier", "décortiquer", "échalas", "fendiller"
        ];
        
        for ($i = 0; $i < 25; $i++) {
            $mot = new MotsCles();
            $mot->setLibelle($mots_cles[mt_rand(0, 24)]);
            $manager->persist($mot);
            $mots[] = $mot;
        }
        
        for ($i = 0; $i < 10; $i++) {
            $commentaire = "";
            $marquePage = new MarquePage();
            $marquePage->setUrl("https://".$mots_cles[mt_rand(0, 24)].$mots_cles[mt_rand(0, 24)].".com");
            $marquePage->setDateCreation(new \DateTime());
            for ($j = 0; $j < 5; $j++) {
                $commentaire = $commentaire . " " . $mots_cles[mt_rand(0, 24)];
            }
            $marquePage->setCommentaire($commentaire);
            $random =  mt_rand(2, 5);
            for ($j = 0; $j < $random; $j++) {
                    $marquePage->addMotsCle($mots[mt_rand(0, 24)]);
            }
            
            $manager->persist($marquePage);
        } 
        
        $manager->flush();
    }
}
