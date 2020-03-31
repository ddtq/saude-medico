<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\PostgresTypes\InetType;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TriagemRepository")
 */
class Triagem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $dtTriagem;

    /**
     * @ORM\Column(type="inet")
     */
    private $ip;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TriagemSituacao", inversedBy="triagens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $triagemSituacao;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observacao;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $sintomas;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $telefoneCelular;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $telefoneFixo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Resposta", mappedBy="triagem")
     */
    private $respostas;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Policial", inversedBy="triagens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $policial;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ResultadoTriagem", inversedBy="triagens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $resultadoTriagem;

    public function __construct()
    {
        $this->respostas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDtTriagem(): ?DateTimeInterface
    {
        return $this->dtTriagem;
    }

    public function setDtTriagem(DateTimeInterface $dtTriagem): self
    {
        $this->dtTriagem = $dtTriagem;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getTriagemSituacao(): ?TriagemSituacao
    {
        return $this->triagemSituacao;
    }

    public function setTriagemSituacao(?TriagemSituacao $triagemSituacao): self
    {
        $this->triagemSituacao = $triagemSituacao;

        return $this;
    }

    public function getObservacao(): ?string
    {
        return $this->observacao;
    }

    public function setObservacao(?string $observacao): self
    {
        $this->observacao = $observacao;

        return $this;
    }

    public function getSintomas(): ?string
    {
        return $this->sintomas;
    }

    public function setSintomas(?string $sintomas): self
    {
        $this->sintomas = $sintomas;

        return $this;
    }

    public function getTelefoneCelular(): ?string
    {
        return $this->telefoneCelular;
    }

    public function setTelefoneCelular(string $telefoneCelular): self
    {
        $this->telefoneCelular = $telefoneCelular;

        return $this;
    }

    public function getTelefoneFixo(): ?string
    {
        return $this->telefoneFixo;
    }

    public function setTelefoneFixo(?string $telefoneFixo): self
    {
        $this->telefoneFixo = $telefoneFixo;

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
            $resposta->setTriagem($this);
        }

        return $this;
    }

    public function removeResposta(Resposta $resposta): self
    {
        if ($this->respostas->contains($resposta)) {
            $this->respostas->removeElement($resposta);
            // set the owning side to null (unless already changed)
            if ($resposta->getTriagem() === $this) {
                $resposta->setTriagem(null);
            }
        }

        return $this;
    }

    public function getPolicial(): ?Policial
    {
        return $this->policial;
    }

    public function setPolicial(?Policial $policial): self
    {
        $this->policial = $policial;

        return $this;
    }

    public function getResultadoTriagem(): ?ResultadoTriagem
    {
        return $this->resultadoTriagem;
    }

    public function setResultadoTriagem(?ResultadoTriagem $resultadoTriagem): self
    {
        $this->resultadoTriagem = $resultadoTriagem;

        return $this;
    }

}
