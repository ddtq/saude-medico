<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SexoRepository")
 */
class Sexo
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string",length=20)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $descricao;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Policial", mappedBy="sexo")
     */
    private $policiais;

    public function __construct()
    {
        $this->policiais = new ArrayCollection();
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?string
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
            $policial->setSexo($this);
        }

        return $this;
    }

    public function removePolicial(Policial $policial): self
    {
        if ($this->policiais->contains($policial)) {
            $this->policiais->removeElement($policial);
            // set the owning side to null (unless already changed)
            if ($policial->getSexo() === $this) {
                $policial->setSexo(null);
            }
        }

        return $this;
    }
}
