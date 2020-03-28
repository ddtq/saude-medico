<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PolicialRepository")
 */
class Policial
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $rg;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $nome;

    /**
     * @ORM\Column(name="data_nascimento",type="datetimetz")
     */
    private $dataNascimento;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $quadro;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $subquadro;

    /**
     * @ORM\Column(name="opm_meta4_id",type="string", length=15)
     */
    private $opmMeta4Id;

    /**
     * @ORM\Column(name="opm_nome",type="string", length=80)
     */
    private $opmNome;

    /**
     * @ORM\Column(name="opm_abrev",type="string",length=80)
     */
    private $opmAbrev;

    /**
     * @ORM\Column(name="created_at",type="datetimetz")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoRh", inversedBy="policiais")
     * @ORM\JoinColumn(name="tipo_rh_id",nullable=false, referencedColumnName="id")
     */
    private $tipoRh;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cargo",inversedBy="policiais")
     * @ORM\JoinColumn(name="cargo_id",referencedColumnName="id")
     */
    private $cargo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sexo", inversedBy="policials")
     * @ORM\JoinColumn(name="sexo_id",nullable=false,referencedColumnName="id")
     */
    private $sexo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Triagem", mappedBy="policial")
     */
    private $triagens;

    /**
     * @ORM\Column(name="municipio",type="string", length=50)
     */
    private $municipio;

    public function __construct()
    {
        $this->triagens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

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

    public function getDataNascimento(): ?DateTimeInterface
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento(DateTimeInterface $dataNascimento): self
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    public function getQuadro(): ?string
    {
        return $this->quadro;
    }

    public function setQuadro(string $quadro): self
    {
        $this->quadro = $quadro;

        return $this;
    }

    public function getSubquadro(): ?string
    {
        return $this->subquadro;
    }

    public function setSubquadro(string $subquadro): self
    {
        $this->subquadro = $subquadro;

        return $this;
    }

    public function getOpmMeta4Id(): ?string
    {
        return $this->opmMeta4Id;
    }

    public function setOpmMeta4Id(string $opmMeta4Id): self
    {
        $this->opmMeta4Id = $opmMeta4Id;

        return $this;
    }

    public function getOpmNome(): ?string
    {
        return $this->opmNome;
    }

    public function setOpmNome(string $opmNome): self
    {
        $this->opmNome = $opmNome;

        return $this;
    }

    public function getOpmAbrev(): ?string
    {
        return $this->opmAbrev;
    }

    public function setOpmAbrev(string $opmAbrev): self
    {
        $this->opmAbrev = $opmAbrev;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getTipoRh(): ?TipoRh
    {
        return $this->tipoRh;
    }

    public function setTipoRh(?TipoRh $tipoRh): self
    {
        $this->tipoRh = $tipoRh;

        return $this;
    }

    public function getCargo(): ?Cargo
    {
        return $this->cargo;
    }

    public function setCargo(?Cargo $cargo): self
    {
        $this->cargo = $cargo;

        return $this;
    }

    public function getSexo(): ?Sexo
    {
        return $this->sexo;
    }

    public function setSexo(?Sexo $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * @return Collection|Triagem[]
     */
    public function getTriagens(): Collection
    {
        return $this->triagens;
    }

    public function getMunicipio(): ?string
    {
        return $this->municipio;
    }

    public function setMunicipio(string $municipio): self
    {
        $this->municipio = $municipio;

        return $this;
    }

    public function addTriagem(Triagem $triagem): self
    {
        if (!$this->triagens->contains($triagem)) {
            $this->triagens[] = $triagem;
            $triagem->setPolicialId($this);
        }

        return $this;
    }

    public function removeTriagem(Triagem $triagem): self
    {
        if ($this->triagens->contains($triagem)) {
            $this->triagens->removeElement($triagem);
            // set the owning side to null (unless already changed)
            if ($triagem->getPolicial() === $this) {
                $triagem->setPolicial(null);
            }
        }

        return $this;
    }
}
