<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CargoRepository")
 * ApiResource()
 */
class Cargo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $descricao;

    /**
     * @ORM\Column(type="integer")
     */
    private $ordem;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Policial", mappedBy="cargo_id")
     */
    private $policials;

    public function __construct()
    {
        $this->policials = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getOrdem(): ?int
    {
        return $this->ordem;
    }

    public function setOrdem(int $ordem): self
    {
        $this->ordem = $ordem;

        return $this;
    }

    /**
     * @return Collection|Policial[]
     */
    public function getPolicials(): Collection
    {
        return $this->policials;
    }

    public function addPolicial(Policial $policial): self
    {
        if (!$this->policials->contains($policial)) {
            $this->policials[] = $policial;
            $policial->setCargoId($this);
        }

        return $this;
    }

    public function removePolicial(Policial $policial): self
    {
        if ($this->policials->contains($policial)) {
            $this->policials->removeElement($policial);
            // set the owning side to null (unless already changed)
            if ($policial->getCargoId() === $this) {
                $policial->setCargoId(null);
            }
        }

        return $this;
    }
}
