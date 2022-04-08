<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use App\Entity\Commande;
use App\Entity\DetailCommande;
use App\DataFixtures\ProduitFixtures;
use App\DataFixtures\CommandeFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class DetailCommandeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        // Obtenir les commandes
        $rep = $manager->getRepository(Commande::class);
        $commandes = $rep->findAll();

        // Obtenir les produits
        $rep = $manager->getRepository(Produit::class);
        $produits = $rep->findAll();

        //Créer les details de la commande
        for ($i = 0; $i < 100; $i++) {

            //Affecter une commande random et un produit random
            $commandeChoisie = $commandes[rand(0, count($commandes) - 1)];
            $produitChoisi = $produits[rand(0, count($produits) - 1)];

            $detailCommande = new DetailCommande();
            $detailCommande->setProduit($produitChoisi);
            $detailCommande->setCommande($commandeChoisie);
            $detailCommande->setQuantite(rand(5, 20));
            
            $commandeChoisie->addDetailCommande($detailCommande);
            $produitChoisi->addDetailCommande($detailCommande);

            $manager->persist($detailCommande);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return ([
            ProduitFixtures::class,
            CommandeFixtures::class
        ]);
    }
}
