<?php

namespace App\Entity;

use App\Repository\DetailCommandeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailCommandeRepository::class)]
class DetailCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $quantite;

    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'detailCommande')]
    private $commande;

    #[ORM\ManyToOne(targetEntity: Produit::class, inversedBy: 'detailCommande')]
    private $produit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    //Méthode pour savoir si deux détails sont pareils
    //Comparer le détail en cours avec un détail passé en paramètre
    //Ces détails doivent avoir déjà un id, c'est à dire exister préalablement dans la BD
    public function equals(DetailCommande $detail): bool {
        return $this->getProduit()->getId() == $detail->getProduit()->getId();
    }

    //Obtenir le prix d'un détail
    public function getTotal():float {
        return $this->getProduit()->getPrix() * $this->getQuantite();
    }
}
