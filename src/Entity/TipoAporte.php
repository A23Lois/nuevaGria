<?php

namespace App\Entity;

use App\Repository\TipoAporteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TipoAporteRepository::class)]
class TipoAporte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $tipoAporte = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipoAporte(): ?string
    {
        return $this->tipoAporte;
    }

    public function setTipoAporte(string $tipoAporte): static
    {
        $this->tipoAporte = $tipoAporte;

        return $this;
    }
}
