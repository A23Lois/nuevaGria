<?php

namespace App\Entity;

use App\Repository\GeneroRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GeneroRepository::class)]
class Genero
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $genero = null;

    #[ORM\Column]
    private ?int $tipoMedia = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(string $genero): static
    {
        $this->genero = $genero;

        return $this;
    }

    public function getTipoMedia(): ?int
    {
        return $this->tipoMedia;
    }

    public function setTipoMedia(int $tipoMedia): static
    {
        $this->tipoMedia = $tipoMedia;

        return $this;
    }
}
