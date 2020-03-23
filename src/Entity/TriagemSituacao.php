<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TriagemSituacaoRepository")
 */
class TriagemSituacao
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
     * @ORM\Column(type="datetimetz")
     */
    private $dt_ini;

    /**
     * @ORM\Column(type="datetimetz", nullable=true)
     */
    private $dt_fim;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Triagem", mappedBy="triagem_situacao_id")
     */
    private $triagems;

    public function __construct()
    {
        $this->triagems = new ArrayCollection();
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

    public function getDtIni(): ?\DateTimeInterface
    {
        return $this->dt_ini;
    }

    public function setDtIni(\DateTimeInterface $dt_ini): self
    {
        $this->dt_ini = $dt_ini;

        return $this;
    }

    public function getDtFim(): ?\DateTimeInterface
    {
        return $this->dt_fim;
    }

    public function setDtFim(?\DateTimeInterface $dt_fim): self
    {
        $this->dt_fim = $dt_fim;

        return $this;
    }

    /**
     * @return Collection|Triagem[]
     */
    public function getTriagems(): Collection
    {
        return $this->triagems;
    }

    public function addTriagem(Triagem $triagem): self
    {
        if (!$this->triagems->contains($triagem)) {
            $this->triagems[] = $triagem;
            $triagem->setTriagemSituacaoId($this);
        }

        return $this;
    }

    public function removeTriagem(Triagem $triagem): self
    {
        if ($this->triagems->contains($triagem)) {
            $this->triagems->removeElement($triagem);
            // set the owning side to null (unless already changed)
            if ($triagem->getTriagemSituacaoId() === $this) {
                $triagem->setTriagemSituacaoId(null);
            }
        }

        return $this;
    }
}
