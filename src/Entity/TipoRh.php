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
    public const TIPO_RH_ATIVA="TIPO_RH_ATIVA";
    public const TIPO_RH_APOSENTADO="TIPO_RH_APOSENTADO";

    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=30)
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

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $diIni;

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

    public function getDiIni(): ?\DateTimeInterface
    {
        return $this->diIni;
    }

    public function setDiIni(\DateTimeInterface $diIni): self
    {
        $this->diIni = $diIni;

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
