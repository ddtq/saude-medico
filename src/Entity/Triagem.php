<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private $dt_hr_triagem;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $ip;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TriagemSituacao", inversedBy="triagems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $triagem_situacao_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observacao;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $simtomas;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $telefone_celular;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $telefone_fixo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Resposta", mappedBy="triagem_id")
     */
    private $respostas;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Policial", inversedBy="triagems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $policial_id;

    public function __construct()
    {
        $this->respostas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDtHrTriagem(): ?\DateTimeInterface
    {
        return $this->dt_hr_triagem;
    }

    public function setDtHrTriagem(\DateTimeInterface $dt_hr_triagem): self
    {
        $this->dt_hr_triagem = $dt_hr_triagem;

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

    public function getTriagemSituacaoId(): ?TriagemSituacao
    {
        return $this->triagem_situacao_id;
    }

    public function setTriagemSituacaoId(?TriagemSituacao $triagem_situacao_id): self
    {
        $this->triagem_situacao_id = $triagem_situacao_id;

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

    public function getSimtomas(): ?string
    {
        return $this->simtomas;
    }

    public function setSimtomas(?string $simtomas): self
    {
        $this->simtomas = $simtomas;

        return $this;
    }

    public function getTelefoneCelular(): ?string
    {
        return $this->telefone_celular;
    }

    public function setTelefoneCelular(string $telefone_celular): self
    {
        $this->telefone_celular = $telefone_celular;

        return $this;
    }

    public function getTelefoneFixo(): ?string
    {
        return $this->telefone_fixo;
    }

    public function setTelefoneFixo(?string $telefone_fixo): self
    {
        $this->telefone_fixo = $telefone_fixo;

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
            $resposta->setTriagemId($this);
        }

        return $this;
    }

    public function removeResposta(Resposta $resposta): self
    {
        if ($this->respostas->contains($resposta)) {
            $this->respostas->removeElement($resposta);
            // set the owning side to null (unless already changed)
            if ($resposta->getTriagemId() === $this) {
                $resposta->setTriagemId(null);
            }
        }

        return $this;
    }

    public function getPolicialId(): ?Policial
    {
        return $this->policial_id;
    }

    public function setPolicialId(?Policial $policial_id): self
    {
        $this->policial_id = $policial_id;

        return $this;
    }

}
