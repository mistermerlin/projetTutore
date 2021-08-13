<?php

namespace App\Entity;

use App\Repository\LocaliteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocaliteRepository::class)
 */
class Localite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Iep::class, mappedBy="localite", orphanRemoval=true)
     */
    private $ieps;

    /**
     * @ORM\ManyToOne(targetEntity=Permutation::class, inversedBy="localiteDepart")
     */
    private $permutation;

    public function __construct()
    {
        $this->ieps = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nom;
    }

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

    /**
     * @return Collection|Iep[]
     */
    public function getIeps(): Collection
    {
        return $this->ieps;
    }

    public function addIep(Iep $iep): self
    {
        if (!$this->ieps->contains($iep)) {
            $this->ieps[] = $iep;
            $iep->setLocalite($this);
        }

        return $this;
    }

    public function removeIep(Iep $iep): self
    {
        if ($this->ieps->removeElement($iep)) {
            // set the owning side to null (unless already changed)
            if ($iep->getLocalite() === $this) {
                $iep->setLocalite(null);
            }
        }

        return $this;
    }

    public function getPermutation(): ?Permutation
    {
        return $this->permutation;
    }

    public function setPermutation(?Permutation $permutation): self
    {
        $this->permutation = $permutation;

        return $this;
    }
}
