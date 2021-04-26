<?php

namespace App\Entity;

use App\Repository\MotsClesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MotsClesRepository::class)
 */
class MotsCles
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
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=MarquePage::class, inversedBy="mots_cles")
     */
    private $marque_page;

    public function __construct()
    {
        $this->marque_page = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|marquePage[]
     */
    public function getMarquePage(): Collection
    {
        return $this->marque_page;
    }

    public function addMarquePage(marquePage $marquePage): self
    {
        if (!$this->marque_page->contains($marquePage)) {
            $this->marque_page[] = $marquePage;
        }

        return $this;
    }

    public function removeMarquePage(marquePage $marquePage): self
    {
        $this->marque_page->removeElement($marquePage);

        return $this;
    }
}
