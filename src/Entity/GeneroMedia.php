<?php

namespace App\Entity;

use App\Repository\GeneroMediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GeneroMediaRepository::class)]
class GeneroMedia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idGenero = null;

    #[ORM\Column]
    private ?int $idMedia = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdGenero(): ?int
    {
        return $this->idGenero;
    }

    public function setIdGenero(int $idGenero): static
    {
        $this->idGenero = $idGenero;

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
