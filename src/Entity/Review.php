<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateReview;

    #[ORM\Column(type: 'text', nullable: true)]
    private $commentaireReview;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'review')]
    private $client;

    #[ORM\ManyToOne(targetEntity: Produit::class, inversedBy: 'review')]
    private $produit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateReview(): ?\DateTimeInterface
    {
        return $this->dateReview;
    }

    public function setDateReview(?\DateTimeInterface $dateReview): self
    {
        $this->dateReview = $dateReview;

        return $this;
    }

    public function getCommentaireReview(): ?string
    {
        return $this->commentaireReview;
    }

    public function setCommentaireReview(?string $commentaireReview): self
    {
        $this->commentaireReview = $commentaireReview;

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

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }
}
