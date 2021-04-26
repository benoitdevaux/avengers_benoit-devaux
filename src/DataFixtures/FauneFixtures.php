<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Faune;

class FauneFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faunes = [
            [
                'img' => "img/kagou.jpg",
                'desc' => "Cet oiseau dont l'aspect général n'est pas très éloigné de celui d'un héron affiche une livrée presque entièrement gris-cendre et blanche. Sur les parties supérieures, les couvertures alaires et la queue ont une apparence plus foncée, tirant sur le gris-bleu."
            ],
            [
                'img' => "img/notou.jpg",
                'desc' => "Il vit dans les forêts humides tropicales de la Grande Terre et se nourrit principalement de graines, de baies ou de fruits.  Il raffole des graines de palmiers et de graines de fausses aubergines."
                ]
            ];
            
        foreach ($faunes as $faune) {
            $animal = new Faune();
            $animal->setPhoto($faune['img']);
            $animal->setDescription($faune['desc']);
            $manager->persist($animal);
        }
            
        $manager->flush();
    }
        
}

    