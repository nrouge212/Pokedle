<?php

namespace App\Entity;

use App\Repository\PropositionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PropositionRepository::class)]
class Proposition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $number_try = null;

    #[ORM\ManyToOne(inversedBy: 'propositions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Game $game = null;

    #[ORM\ManyToOne(inversedBy: 'propositions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pokemon $pokemon = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberTry(): ?int
    {
        return $this->number_try;
    }

    public function setNumberTry(int $number_try): static
    {
        $this->number_try = $number_try;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): static
    {
        $this->game = $game;

        return $this;
    }

    public function getPokemon(): ?Pokemon
    {
        return $this->pokemon;
    }

    public function setPokemon(?Pokemon $pokemon): static
    {
        $this->pokemon = $pokemon;

        return $this;
    }
}
