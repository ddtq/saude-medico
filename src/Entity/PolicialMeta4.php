<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class PolicialMeta4
{
    private $rg;
    private $nome;
    private $tipoRhId;
    private $dataNascimento;
    private $cargoId;
    private $quadro;
    private $subquadro;
    private $sexoId;
    private $opmMeta4Id;
    private $opmNome;
    private $opmAbrev;
    private $createdAt;


    public function getRg(): ?string
    {
        return $this->rg;
    }

    public function setRg(string $rg): self
    {
        $this->rg = $rg;

        return $this;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getTipoRhId(): ?string
    {
        return $this->tipoRhId;
    }

    public function setTipoRhId(string $tipoRhId): self
    {
        $this->tipoRhId = $tipoRhId;

        return $this;
    }

    public function getDataNascimento(): ?\DateTimeInterface
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento(\DateTimeInterface $dataNascimento): self
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    public function getCargoId(): ?string
    {
        return $this->cargoId;
    }

    public function setCargoId(string $cargoId): self
    {
        $this->cargoId = $cargoId;

        return $this;
    }

    public function getQuadro(): ?string
    {
        return $this->quadro;
    }

    public function setQuadro(?string $quadro): self
    {
        $this->quadro = $quadro;

        return $this;
    }

    public function getSubquadro(): ?string
    {
        return $this->subquadro;
    }

    public function setSubquadro(?string $subquadro): self
    {
        $this->subquadro = $subquadro;

        return $this;
    }

    public function getSexoId(): ?string
    {
        return $this->sexoId;
    }

    public function setSexoId(string $sexoId): self
    {
        $this->sexoId = $sexoId;

        return $this;
    }

    public function getOpmMeta4Id(): ?string
    {
        return $this->opmMeta4Id;
    }

    public function setOpmMeta4Id(?string $opmMeta4Id): self
    {
        $this->opmMeta4Id = $opmMeta4Id;

        return $this;
    }

    public function getOpmNome(): ?string
    {
        return $this->opmNome;
    }

    public function setOpmNome(?string $opmNome): self
    {
        $this->opmNome = $opmNome;

        return $this;
    }

    public function getOpmAbrev(): ?string
    {
        return $this->opmAbrev;
    }

    public function setOpmAbrev(?string $opmAbrev): self
    {
        $this->opmAbrev = $opmAbrev;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
