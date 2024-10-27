<?php

namespace App\Entity;

use App\Repository\PersonaMediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonaMediaRepository::class)]
class PersonaMedia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idPersona = null;

    #[ORM\Column]
    private ?int $idMedia = null;

    #[ORM\Column]
    private ?int $idTipoAporte = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPersona(): ?int
    {
        return $this->idPersona;
    }

    public function setIdPersona(int $idPersona): static
    {
        $this->idPersona = $idPersona;

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
