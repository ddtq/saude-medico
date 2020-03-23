<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RespostaRepository")
 */
class Resposta
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $resposta;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pergunta", inversedBy="respostas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pergunta_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Triagem", inversedBy="respostas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $triagem_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResposta(): ?bool
    {
        return $this->resposta;
    }

    public function setResposta(bool $resposta): self
    {
        $this->resposta = $resposta;

        return $this;
    }

    public function getPerguntaId(): ?Pergunta
    {
        return $this->pergunta_id;
    }

    public function setPerguntaId(?Pergunta $pergunta_id): self
    {
        $this->pergunta_id = $pergunta_id;

        return $this;
    }

    public function getTriagemId(): ?Triagem
    {
        return $this->triagem_id;
    }

    public function setTriagemId(?Triagem $triagem_id): self
    {
        $this->triagem_id = $triagem_id;

        return $this;
    }
}
