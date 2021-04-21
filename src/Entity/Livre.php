<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LivreRepository::class)
 */
class Livre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="integer")
     */
    private $anneeParution;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrePage;

    /**
     * @ORM\ManyToOne(targetEntity=Auteur::class, inversedBy="livre")
     * @ORM\JoinColumn(nullable=false)
     */
    private $auteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAnneeParution(): ?int
    {
        return $this->anneeParution;
    }

    public function setAnneeParution(int $anneeParution): self
    {
        $this->anneeParution = $anneeParution;

        return $this;
    }

    public function getNbrePage(): ?int
    {
        return $this->nbrePage;
    }

    public function setNbrePage(int $nbrePage): self
    {
        $this->nbrePage = $nbrePage;

        return $this;
    }

    public function getAuteur(): ?Auteur
    {
        return $this->auteur;
    }

    public function setAuteur(?Auteur $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }
}
