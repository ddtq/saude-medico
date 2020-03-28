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
    public const ATIVA="ATIVA";
    public const APOSENTADO="APOSENTADO";

    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=30)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $descricao;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Policial", mappedBy="tipoRh")
     */
    private $policiais;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $dtIni;

    /**
     * @ORM\Column(type="datetimetz", nullable=true)
     */
    private $dtFim;

    public function __construct()
    {
        $this->policiais = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

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

    public function getDtIni(): ?\DateTimeInterface
    {
        return $this->dtIni;
    }

    public function setDtIni(\DateTimeInterface $dtIni): self
    {
        $this->dtIni = $dtIni;

        return $this;
    }

    public function getDtFim(): ?\DateTimeInterface
    {
        return $this->dtFim;
    }

    public function setDtFim(?\DateTimeInterface $dtFim): self
    {
        $this->dtFim = $dtFim;

        return $this;
    }

}
