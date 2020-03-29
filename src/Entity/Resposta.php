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
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $selected;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pergunta", inversedBy="respostas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pergunta;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Triagem", inversedBy="respostas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $triagem;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPergunta(): ?Pergunta
    {
        return $this->pergunta;
    }

    public function setPergunta(?Pergunta $pergunta): self
    {
        $this->pergunta = $pergunta;

        return $this;
    }

    public function getTriagem(): ?Triagem
    {
        return $this->triagem;
    }

    public function setTriagem(?Triagem $triagem): self
    {
        $this->triagem = $triagem;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSelected()
    {
        return $this->selected;
    }

    /**
     * @param mixed $selected
     * @return Resposta
     */
    public function setSelected($selected)
    {
        $this->selected = $selected;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     * @return Resposta
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

}
