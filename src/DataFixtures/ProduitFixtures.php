<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager){
        $p1 = new Produit();
        $p1->setTitre("The sweety");
        $p1->setReference("001");
        $p1->setPhoto("product-1.jpg");
        $p1->setDescription("Blablablallalalalaaaaaaaaa");
        $p1->setPrix(5);
        $p1->setOdeur("Lavande");
        $p1->setCouleur("Purple");
        $manager->persist($p1);
        $manager->flush();

        $p2 = new Produit();
        $p2->setTitre("The scrumby");
        $p2->setReference("002");
        $p2->setPhoto("product-2.jpg");
        $p2->setDescription("Blablablallalalalaaaaaaaaa");
        $p2->setPrix(5);
        $p2->setOdeur("Santal wood");
        $p2->setCouleur("Charcoal");
        $manager->persist($p2);
        $manager->flush();

        $p3 = new Produit();
        $p3->setTitre("The fluffy");
        $p3->setReference("003");
        $p3->setPhoto("product-3.jpg");
        $p3->setDescription("Blablablallalalalaaaaaaaaa");
        $p3->setPrix(5);
        $p3->setOdeur("Almond");
        $p3->setCouleur("White");
        $manager->persist($p3);
        $manager->flush();

        $p4 = new Produit();
        $p4->setTitre("The Original");
        $p4->setReference("004");
        $p4->setPhoto("product-4.jpg");
        $p4->setDescription("Blablablallalalalaaaaaaaaa");
        $p4->setPrix(5);
        $p4->setOdeur("Lavande");
        $p4->setCouleur("Egg");
        $manager->persist($p4);
        $manager->flush();

        $p5 = new Produit();
        $p5->setTitre("The granny");
        $p5->setReference("005");
        $p5->setPhoto("product-5.jpg");
        $p5->setDescription("Blablablallalalalaaaaaaaaa");
        $p5->setPrix(5);
        $p5->setOdeur("Rose");
        $p5->setCouleur("Pink");
        $manager->persist($p5);
        $manager->flush();

        $p6 = new Produit();
        $p6->setTitre("The Freshy");
        $p6->setReference("006");
        $p6->setPhoto("product-6.jpg");
        $p6->setDescription("Blablablallalalalaaaaaaaaa");
        $p6->setPrix(5);
        $p6->setOdeur("Mint");
        $p6->setCouleur("Green");
        $manager->persist($p6);
        $manager->flush();
    }
}
