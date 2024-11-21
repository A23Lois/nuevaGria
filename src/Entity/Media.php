<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(length: 255)]
    private ?string $tituloOriginal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $urlImagen = null;
    #[ORM\Column]
    private ?int $idTipoMedia = null;

    #[ORM\Column(nullable: true)]
    private ?int $idPrecuela = null;

    #[ORM\Column(nullable: true)]
    private ?int $idSecuela = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaEstreno = null;

    #[ORM\Column(nullable: true)]
    private ?string $descripcion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getTituloOriginal(): ?string
    {
        return $this->tituloOriginal;
    }

    public function setTituloOriginal(string $tituloOriginal): static
    {
        $this->tituloOriginal = $tituloOriginal;

        return $this;
    }

    public function getIdTipoMedia(): ?int
    {
        return $this->idTipoMedia;
    }

    public function setIdTipoMedia(int $idTipoMedia): static
    {
        $this->idTipoMedia = $idTipoMedia;

        return $this;
    }

    public function getIdPrecuela(): ?int
    {
        return $this->idPrecuela;
    }

    public function setIdPrecuela(?int $idPrecuela): static
    {
        $this->idPrecuela = $idPrecuela;

        return $this;
    }

    public function getIdSecuela(): ?int
    {
        return $this->idSecuela;
    }

    public function setIdSecuela(?int $idSecuela): static
    {
        $this->idSecuela = $idSecuela;

        return $this;
    }

    public function getFechaEstreno(): ?\DateTimeInterface
    {
        return $this->fechaEstreno;
    }

    public function setFechaEstreno(\DateTimeInterface $fechaEstreno): static
    {
        $this->fechaEstreno = $fechaEstreno;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }


    public function getUrlImagen(): ?string
    {
        return $this->urlImagen;
    }

    public function setUrlImagen(?string $urlImagen): static
    {
        $this->urlImagen = $urlImagen;

        return $this;
    }
}
