<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Commande;
use App\Entity\DetailCommande;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    #[Route('/panier/afficher', name: 'basket')]
    public function index(SessionInterface $session, ProduitRepository $repProduit): Response
    {
        $panierCommande = $session->get('panierCommande', new Commande());

        $vars = ['panierCommande' => $panierCommande];
        return $this->render('panier/basket.html.twig', $vars);
    }


    #[Route('/panier/ajouter', name: 'basket-add-product')]
    public function addProduitPlusieurs(Request $req, SessionInterface $session, ProduitRepository $repProduit): Response {

        $id = $req->request->get('id');
        $quantite = $req->request->get('quantite');

        $panierCommande = $session->get('panierCommande', new Commande()); 
        
        $detail = new DetailCommande();
        
        $produit = $repProduit->find($id);
        
        $produit->addDetailCommande($detail);

        $detail->setQuantite($quantite); 
      
        $panierCommande->addDetailCommande($detail);     

        $session->set('panierCommande', $panierCommande);
        return $this->redirectToRoute('basket');
    }


    #[Route('/panier/ajouter/detail/{id}', name: 'basket-add-detail-product')]
    public function panierAddDetail(Request $req, SessionInterface $session, ProduitRepository $repProduit): Response {

        $id = $req->get('id'); // id du produit à rajouter

        $panierCommande = $session->get('panierCommande', new Commande()); // si la variable 'panier' n'existe pas, on initialise l'array

        $detail = new DetailCommande();
        $detail->setProduit($repProduit->find($id));
        $detail->setQuantite(1); // ou plus (reçu en paramètre tel que l'id), si vous mettez un champ pour choisir la quantité dans l'interface

        $panierCommande->addDetailCommande($detail);  // regardez le code de addDetail       

        $session->set('panierCommande', $panierCommande);
        return $this->redirectToRoute('basket');
    }


    #[Route('/panier/effacer/detail/{id}', name: 'basket-remove-detail-product')]
    public function panierRemoveDetail(Request $req, SessionInterface $session, ProduitRepository $repProduit): Response {

        $id = $req->get('id');

        $panierCommande = $session->get('panierCommande', new Commande()); 

        $detail = new DetailCommande();
        $detail->setProduit($repProduit->find($id));
        $detail->setQuantite(1); 

        $panierCommande->removeDetailCommande($detail);      

        $session->set('panierCommande', $panierCommande);
        return $this->redirectToRoute('basket');
    }


    #[Route('/panier/effacer/all/{id}', name: 'basket-delete-product')]
    public function panierEffacerDetail(Request $req, SessionInterface $session) {

        $panierCommande = $session->get("panierCommande");

        $detailsCommandeSession = $panierCommande->getDetailCommande();
        foreach ($panierCommande->getDetailCommande() as $key => $detailSession){
            if ($req->get('id') == $detailSession->getProduit()->getId()){
                $detailsCommandeSession->removeElement($detailSession);
                // plus besoin de chercher, on redirige
                return $this->redirectToRoute('basket');

            }
        }
        return $this->redirectToRoute('basket');
    }


}
