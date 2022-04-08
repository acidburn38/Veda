<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\DetailCommande;
use App\Entity\Produit;
use App\Repository\CommandeRepository;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
    #[Route('/commande/passer', name: 'order')]
    public function commandePasser(SessionInterface $session, ManagerRegistry $doctrine): Response {

        $commandePanier = $session->get('panierCommande');

        // créer une commande, la persister et puis affecter cette commande
        // avec la commande de la session (rajouter les détails - et eventuellement un client)
        $commandeBD = new Commande();
        $em = $doctrine->getManager();
        // on initisalise tout ce qu'on a de la commande avant de faire le persist
        // (client - $this->getUser(), dateCreation, etc...)
        // et puis on copie les détails du panier
        $total=0;
    
        
        $commandeBD->setDateCommande(new DateTime());
        /*$em->persist($commandeBD);
        $em->flush();*/
        
        // on a maintenant une commande avec un id
        foreach ($commandePanier->getDetailCommande() as $detailCommande) {
            $commandeBD->addDetailCommande($detailCommande);
            
        }
        
        //dd($commandeBD->getDetailCommande());
        foreach ($commandeBD->getDetailCommande() as $detail ) {
            $prixUnitaire = $detail->getProduit()->getPrix();
            $prixTotalParProduit = $prixUnitaire * $detail->getQuantite();
            //dd($prixTotalParProduit);
            $total += $prixTotalParProduit;
            //dd( $total);
        }
        
        $commandeBD->setMontantTotal($total);
        $em->persist($commandeBD);
        $em->flush(); // mettre à jour une fois les détails sont là

        $vars = ['commandeBD' => $commandeBD];
        return $this->render('commande/order.html.twig', $vars);
    }
}
