<?php

namespace App\Entity;

use App\Repository\EcoleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EcoleRepository::class)
 */
class Ecole
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity=Iep::class, inversedBy="ecoles")
     */
    private $iep;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getIep(): ?Iep
    {
        return $this->iep;
    }

    public function setIep(?Iep $iep): self
    {
        $this->iep = $iep;

        return $this;
    }
}
