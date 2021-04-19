<?php

namespace App\Entity;

use App\Repository\MarquePageRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime as ConstraintsDateTime;

/**
 * @ORM\Entity(repositoryClass=MarquePageRepository::class)
 */
class MarquePage
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
    private $url;

    /**
     * @ORM\Column(type="date")
     */
    private $date_creation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToMany(targetEntity=MotsCles::class, mappedBy="marque_page")
     */
    private $mots_cles;

    public function __construct()
    {
        $this->mots_cles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getDateCreation(): ?DateTime
    {
        return $this->date_creation;
    }

    public function setDateCreation(DateTime $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * @return Collection|MotsCles[]
     */
    public function getMotsCles(): Collection
    {
        return $this->mots_cles;
    }

    public function addMotsCle(MotsCles $motsCle): self
    {
        if (!$this->mots_cles->contains($motsCle)) {
            $this->mots_cles[] = $motsCle;
            $motsCle->addMarquePage($this);
        }

        return $this;
    }

    public function removeMotsCle(MotsCles $motsCle): self
    {
        if ($this->mots_cles->removeElement($motsCle)) {
            $motsCle->removeMarquePage($this);
        }

        return $this;
    }
}
