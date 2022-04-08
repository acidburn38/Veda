<?php

namespace App\Controller;

use App\Entity\Produit;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
    // SELECT: findAll (chercher par un ou plusieurs champs, filtre array)
    #[Route('produit/liste', name: 'product')]
    public function produitListe(ManagerRegistry $doctrine)
    {
        $em = $doctrine->getManager();

        $rep = $em->getRepository(Produit::class);

        // notez que findBy renverra toujours un array même s'il trouve qu'un objet
        $produits = $rep->findAll();
        $vars = ['produits' => $produits];

        return $this->render("produit/liste.html.twig", $vars);
    }

    // SELECT: find (chercher par id)
    #[Route("produit/{id}", name: 'product-detail')]
    public function produitDetail(Produit $produit): Response
    {
        $vars = ['produit' => $produit];
        return $this->render("produit/detail.html.twig", $vars);
    }
}
