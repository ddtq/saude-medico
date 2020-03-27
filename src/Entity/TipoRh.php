<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TipoRhRepository")
 */
class TipoRh
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
    private $decricao;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Policial", mappedBy="tipoRh")
     */
    private $policiais;

    public function __construct()
    {
        $this->policiais = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDecricao(): ?string
    {
        return $this->decricao;
    }

    public function setDecricao(string $decricao): self
    {
        $this->decricao = $decricao;

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
            $policial->setTipoRh($this);
        }

        return $this;
    }

    public function removePolicial(Policial $policial): self
    {
        if ($this->policiais->contains($policial)) {
            $this->policiais->removeElement($policial);
            // set the owning side to null (unless already changed)
            if ($policial->getTipoRh() === $this) {
                $policial->setTipoRh(null);
            }
        }

        return $this;
    }

}
