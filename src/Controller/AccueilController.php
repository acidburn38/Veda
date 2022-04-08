<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ProduitRepository $rep): Response
    {
        $produits = $rep->findAll();
        $vars = ['produits' => $produits];
        return $this->render('accueil/index.html.twig', $vars);
    }

    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('accueil/about.html.twig');
    }

    #[Route('/findUs', name: 'find-us')]
    public function findUs(): Response
    {
        return $this->render('accueil/findUs.html.twig');
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('accueil/contact.html.twig');
    }
}
