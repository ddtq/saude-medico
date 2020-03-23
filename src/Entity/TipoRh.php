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
     * @ORM\OneToMany(targetEntity="App\Entity\Policial", mappedBy="tipo_rh_id")
     */
    private $buscaPorSexo;

    public function __construct()
    {
        $this->buscaPorSexo = new ArrayCollection();
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
    public function getBuscaPorSexo(): Collection
    {
        return $this->buscaPorSexo;
    }

    public function addBuscaPorSexo(Policial $buscaPorSexo): self
    {
        if (!$this->buscaPorSexo->contains($buscaPorSexo)) {
            $this->buscaPorSexo[] = $buscaPorSexo;
            $buscaPorSexo->setTipoRhId($this);
        }

        return $this;
    }

    public function removeBuscaPorSexo(Policial $buscaPorSexo): self
    {
        if ($this->buscaPorSexo->contains($buscaPorSexo)) {
            $this->buscaPorSexo->removeElement($buscaPorSexo);
            // set the owning side to null (unless already changed)
            if ($buscaPorSexo->getTipoRhId() === $this) {
                $buscaPorSexo->setTipoRhId(null);
            }
        }

        return $this;
    }
}
