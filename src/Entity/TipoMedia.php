<?php

namespace App\Entity;

use App\Repository\TipoMediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TipoMediaRepository::class)]
class TipoMedia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $tipoMedia = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipoMedia(): ?string
    {
        return $this->tipoMedia;
    }

    public function setTipoMedia(string $tipoMedia): static
    {
        $this->tipoMedia = $tipoMedia;

        return $this;
    }
}
