<?php

namespace App\Entity;

use App\Repository\StatistiqueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatistiqueRepository::class)
 */
class Statistique
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_stat;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $produit_epuise = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $produit_pres_fin = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $produit_suffisant = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateStat(): ?\DateTimeInterface
    {
        return $this->date_stat;
    }

    public function setDateStat(\DateTimeInterface $date_stat): self
    {
        $this->date_stat = $date_stat;

        return $this;
    }

    public function getProduitEpuise(): ?array
    {
        return $this->produit_epuise;
    }

    public function setProduitEpuise(?array $produit_epuise): self
    {
        $this->produit_epuise = $produit_epuise;

        return $this;
    }

    public function getProduitPresFin(): ?array
    {
        return $this->produit_pres_fin;
    }

    public function setProduitPresFin(?array $produit_pres_fin): self
    {
        $this->produit_pres_fin = $produit_pres_fin;

        return $this;
    }

    public function getProduitSuffisant(): ?array
    {
        return $this->produit_suffisant;
    }

    public function setProduitSuffisant(?array $produit_suffisant): self
    {
        $this->produit_suffisant = $produit_suffisant;

        return $this;
    }
}
