<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ResultadoTriagemRepository")
 */
class ResultadoTriagem
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=40)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $descricao;

    /**
     * @ORM\Column(type="text")
     */
    private $mensagem;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $dtIni;

    /**
     * @ORM\Column(type="datetimetz", nullable=true)
     */
    private $dtFim;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Triagem", mappedBy="resultadoTriagem")
     */
    private $triagens;

    public function __construct()
    {
        $this->triagens = new ArrayCollection();
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

    public function getMensagem(): ?string
    {
        return $this->mensagem;
    }

    public function setMensagem(string $mensagem): self
    {
        $this->mensagem = $mensagem;

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

    /**
     * @return Collection|Triagem[]
     */
    public function getTriagens(): Collection
    {
        return $this->triagens;
    }

    public function addTriagen(Triagem $triagen): self
    {
        if (!$this->triagens->contains($triagen)) {
            $this->triagens[] = $triagen;
            $triagen->setResultadoTriagem($this);
        }

        return $this;
    }

    public function removeTriagen(Triagem $triagen): self
    {
        if ($this->triagens->contains($triagen)) {
            $this->triagens->removeElement($triagen);
            // set the owning side to null (unless already changed)
            if ($triagen->getResultadoTriagem() === $this) {
                $triagen->setResultadoTriagem(null);
            }
        }

        return $this;
    }
}
