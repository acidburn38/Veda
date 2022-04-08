<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Commande;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CommandeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $commande = new Commande();
            $commande
            ->setDateCommande(new DateTime());
            
            $manager->persist($commande);
        }
        $manager->flush();
    }
}
