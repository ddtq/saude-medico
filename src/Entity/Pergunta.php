<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PerguntaRepository")
 */
class Pergunta
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $pergunta;

    /**
     * @ORM\Column(type="text")
     */
    private $informacao;

    /**
     * @ORM\Column(type="integer")
     */
    private $ordem;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $dt_ini;

    /**
     * @ORM\Column(type="datetimetz", nullable=true)
     */
    private $dt_fim;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Resposta", mappedBy="pergunta_id")
     */
    private $respostas;

    public function __construct()
    {
        $this->respostas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPergunta(): ?string
    {
        return $this->pergunta;
    }

    public function setPergunta(string $pergunta): self
    {
        $this->pergunta = $pergunta;

        return $this;
    }

    public function getInformacao(): ?string
    {
        return $this->informacao;
    }

    public function setInformacao(string $informacao): self
    {
        $this->informacao = $informacao;

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
     * @return Collection|Resposta[]
     */
    public function getRespostas(): Collection
    {
        return $this->respostas;
    }

    public function addResposta(Resposta $resposta): self
    {
        if (!$this->respostas->contains($resposta)) {
            $this->respostas[] = $resposta;
            $resposta->setPerguntaId($this);
        }

        return $this;
    }

    public function removeResposta(Resposta $resposta): self
    {
        if ($this->respostas->contains($resposta)) {
            $this->respostas->removeElement($resposta);
            // set the owning side to null (unless already changed)
            if ($resposta->getPerguntaId() === $this) {
                $resposta->setPerguntaId(null);
            }
        }

        return $this;
    }
}
