<?php

namespace App\Entity;

use App\Repository\EmpresaMediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmpresaMediaRepository::class)]
class EmpresaMedia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idEmpresa = null;

    #[ORM\Column]
    private ?int $idMedia = null;

    #[ORM\Column]
    private ?int $idTipoAporte = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEmpresa(): ?int
    {
        return $this->idEmpresa;
    }

    public function setIdEmpresa(int $idEmpresa): static
    {
        $this->idEmpresa = $idEmpresa;

        return $this;
    }

    public function getIdMedia(): ?int
    {
        return $this->idMedia;
    }

    public function setIdMedia(int $idMedia): static
    {
        $this->idMedia = $idMedia;

        return $this;
    }

    public function getIdTipoAporte(): ?int
    {
        return $this->idTipoAporte;
    }

    public function setIdTipoAporte(int $idTipoAporte): static
    {
        $this->idTipoAporte = $idTipoAporte;

        return $this;
    }
}
