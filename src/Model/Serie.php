<?php 

namespace App\Model;

class Serie {
    public function __construct( private int $id, private string $title, private string $genre, private string $creator, private string $status )
    {
        
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    public function getGenre(): string
    {
        return $this->genre;
    }
    public function getCreator(): string
    {
        return $this->creator;
    }
    public function getStatus(): string
    {
        return $this->status;
    }
}
