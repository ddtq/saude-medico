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
     * @ORM\Column(type="string", length=80)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $descricao;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $abreviatura;

    /**
     * @ORM\Column(type="integer")
     */
    private $ordem;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Policial", mappedBy="cargo")
     */
    private $policiais;

    public function __construct()
    {
        $this->policiais = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getAbreviatura()
    {
        return $this->abreviatura;
    }

    public function setAbreviatura($abreviatura): self
    {
        $this->abreviatura = $abreviatura;
        return $this;
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
    public function getPoliciais(): Collection
    {
        return $this->policiais;
    }

    public function addPolicial(Policial $policial): self
    {
        if (!$this->policiais->contains($policial)) {
            $this->policiais[] = $policial;
            $policial->setCargoId($this);
        }

        return $this;
    }

    public function removePolicial(Policial $policial): self
    {
        if ($this->policiais->contains($policial)) {
            $this->policiais->removeElement($policial);
            // set the owning side to null (unless already changed)
            if ($policial->getCargoId() === $this) {
                $policial->setCargoId(null);
            }
        }

        return $this;
    }
}
