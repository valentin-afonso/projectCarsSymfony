<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarRepository::class)
 */
class Car
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Model::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $couleur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nbPlace;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\ManyToMany(targetEntity=Trailer::class)
     */
    private $trailer;

    public function __construct()
    {
        $this->trailer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getNbPlace(): ?string
    {
        return $this->nbPlace;
    }

    public function setNbPlace(string $nbPlace): self
    {
        $this->nbPlace = $nbPlace;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection<int, Trailer>
     */
    public function getTrailer(): Collection
    {
        return $this->trailer;
    }

    public function addTrailer(Trailer $trailer): self
    {
        if (!$this->trailer->contains($trailer)) {
            $this->trailer[] = $trailer;
        }

        return $this;
    }

    public function removeTrailer(Trailer $trailer): self
    {
        $this->trailer->removeElement($trailer);

        return $this;
    }
}
