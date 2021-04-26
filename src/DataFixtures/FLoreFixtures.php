<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Flore;

class FLoreFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $flores = [
            [
                'img' => "img/hibiscus.jpg",
                'desc' => "L’hibiscus enchante nos jardins avec ses innombrables corolles colorées et nous fait voyager vers les mers de Chine. D’entretien très facile il se ressème spontanément et trouve sa place partout dans le jardin."
            ],
            [
                'img' => "img/niaouli.webp",
                'desc' => "Le niaouli est un arbre de la famille des Myrtaceae originaire de la côte orientale de l\'Australie et de Nouvelle-Calédonie. L'espèce a été plantée dans de nombreuses régions tropicales pour l'exploitation de son bois, de ses fleurs pour la production de miel ou de ses feuilles pour la production d'huile essentielle."
                ]
            ];
            
        foreach ($flores as $flore) {
            $fleur = new Flore();
            $fleur->setPhotos($flore['img']);
            $fleur->setDescription($flore['desc']);
            $manager->persist($fleur);
        }
            
        $manager->flush();
    }
}
