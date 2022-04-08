<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateCommande;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $datePaiement;

    #[ORM\Column(type: 'float', nullable: true)]
    private $montantTotal;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'commande')]
    private $client;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: DetailCommande::class, cascade: ['persist', 'remove'])]
    private $detailCommande;

    public function __construct()
    {
        $this->detailCommande = new ArrayCollection();
         //dd($this->detailCommande);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(?\DateTimeInterface $dateCommande): self
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function getDatePaiement(): ?\DateTimeInterface
    {
        return $this->datePaiement;
    }

    public function setDatePaiement(?\DateTimeInterface $datePaiement): self
    {
        $this->datePaiement = $datePaiement;

        return $this;
    }

    public function getMontantTotal(): ?float
    {
        return $this->montantTotal;
    }

    public function setMontantTotal(?float $montantTotal): self
    {
        $this->montantTotal = $montantTotal;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection<int, DetailCommande>
     */
    public function getDetailCommande(): Collection
    {
        return $this->detailCommande;
    }

    //Incrementer la quantité si le detail existe déjà
    //Comparer les deux détails
    public function addDetailCommande(DetailCommande $detailRajouter): self
    {

        foreach ($this->getDetailCommande() as $detailExistant) {
            if ($detailRajouter->equals($detailExistant)) {
                $detailExistant->setQuantite($detailExistant->getQuantite() + $detailRajouter->getQuantite());
                return $this;
            }    
        }
        $this->detailCommande[] = $detailRajouter;
        // dd($this->detailCommande);
        $detailRajouter->setCommande($this);

        return $this;
    }

     //Effacer un détails
    public function removeDetailCommande(DetailCommande $detailDiminuer): self
    {
        $listDetailExistant = $this->getDetailCommande();
        foreach ($listDetailExistant as $detailExistant) {
            $detailExistant->setQuantite($detailExistant->getQuantite()- $detailDiminuer->getQuantite());

            if ($this->detailCommande->removeElement($detailDiminuer)) {
               
                if ($detailDiminuer->getCommande() === $this) {
                    $detailDiminuer->setCommande(null);
                }
            }
        }

        return $this;
    }

     //Effacer tous les détails
     public function removeDetailsCommande(): self
     {
         foreach ($this->getDetailCommande() as $detailCommande) {
             $this->removeDetailCommande($detailCommande);
         }
         return ($this);
     }
 
     //Obtenir le prix de la commande
     public function getTotal(): float
     {
         $total = 0;
         foreach ($this->getDetailCommande() as $detailCommande){
             $total = $total + $detailCommande->getTotal();
         }
         return $total;
     }
}
