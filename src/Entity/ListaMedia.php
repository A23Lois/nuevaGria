<?php

namespace App\Entity;

use App\Repository\ListaMediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListaMediaRepository::class)]
class ListaMedia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idUsuario = null;

    #[ORM\Column]
    private ?int $idMedia = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUsuario(): ?int
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(int $idUsuario): static
    {
        $this->idUsuario = $idUsuario;

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
}
