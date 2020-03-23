<?php

namespace App\Entity;

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
     * @ORM\Column(type="datetimetz")
     */
    private $data_nascimento;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $quadro;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $subquadro;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $opm_meta4_id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $opm_nome;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $opm_abrev;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $created_at;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoRh", inversedBy="buscaPorSexo")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tipo_rh_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cargo", inversedBy="policials")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cargo_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sexo", inversedBy="policials")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sexo_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Triagem", mappedBy="policial_id")
     */
    private $triagems;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $municipio_UF;

    public function __construct()
    {
        $this->triagems = new ArrayCollection();
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

    public function getDataNascimento(): ?\DateTimeInterface
    {
        return $this->data_nascimento;
    }

    public function setDataNascimento(\DateTimeInterface $data_nascimento): self
    {
        $this->data_nascimento = $data_nascimento;

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
        return $this->opm_meta4_id;
    }

    public function setOpmMeta4Id(int $opm_meta4_id): self
    {
        $this->opm_meta4_id = $opm_meta4_id;

        return $this;
    }

    public function getOpmNome(): ?string
    {
        return $this->opm_nome;
    }

    public function setOpmNome(string $opm_nome): self
    {
        $this->opm_nome = $opm_nome;

        return $this;
    }

    public function getOpmAbrev(): ?string
    {
        return $this->opm_abrev;
    }

    public function setOpmAbrev(string $opm_abrev): self
    {
        $this->opm_abrev = $opm_abrev;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getTipoRhId(): ?TipoRh
    {
        return $this->tipo_rh_id;
    }

    public function setTipoRhId(?TipoRh $tipo_rh_id): self
    {
        $this->tipo_rh_id = $tipo_rh_id;

        return $this;
    }

    public function getCargoId(): ?Cargo
    {
        return $this->cargo_id;
    }

    public function setCargoId(?Cargo $cargo_id): self
    {
        $this->cargo_id = $cargo_id;

        return $this;
    }

    public function getSexoId(): ?Sexo
    {
        return $this->sexo_id;
    }

    public function setSexoId(?Sexo $sexo_id): self
    {
        $this->sexo_id = $sexo_id;

        return $this;
    }

    /**
     * @return Collection|Triagem[]
     */
    public function getTriagems(): Collection
    {
        return $this->triagems;
    }

    public function getMunicipioUF(): ?string
    {
        return $this->municipio_UF;
    }

    public function setMunicipioUF(string $municipio_UF): self
    {
        $this->municipio_UF = $municipio_UF;

        return $this;
    }

    public function addTriagem(Triagem $triagem): self
    {
        if (!$this->triagems->contains($triagem)) {
            $this->triagems[] = $triagem;
            $triagem->setPolicialId($this);
        }

        return $this;
    }

    public function removeTriagem(Triagem $triagem): self
    {
        if ($this->triagems->contains($triagem)) {
            $this->triagems->removeElement($triagem);
            // set the owning side to null (unless already changed)
            if ($triagem->getPolicialId() === $this) {
                $triagem->setPolicialId(null);
            }
        }

        return $this;
    }
}
