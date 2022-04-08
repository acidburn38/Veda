<?php

namespace App\Entity;

use App\Repository\TipRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TipRepository::class)]
class Tip
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateTip;

    #[ORM\Column(type: 'text', nullable: true)]
    private $commentaireTip;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'tip')]
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateTip(): ?\DateTimeInterface
    {
        return $this->dateTip;
    }

    public function setDateTip(?\DateTimeInterface $dateTip): self
    {
        $this->dateTip = $dateTip;

        return $this;
    }

    public function getCommentaireTip(): ?string
    {
        return $this->commentaireTip;
    }

    public function setCommentaireTip(?string $commentaireTip): self
    {
        $this->commentaireTip = $commentaireTip;

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
}
