<?php

namespace App\Entity;

use App\Repository\UserHintRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserHintRepository::class)]
class UserHint
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $use_data = null;

    #[ORM\Column]
    private ?int $cost_paid = null;

    #[ORM\ManyToOne(inversedBy: 'userHints')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hint $hint = null;

    #[ORM\ManyToOne(inversedBy: 'userHints')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $player = null;

    #[ORM\ManyToOne(inversedBy: 'userHints')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Game $game = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUseData(): ?\DateTime
    {
        return $this->use_data;
    }

    public function setUseData(\DateTime $use_data): static
    {
        $this->use_data = $use_data;

        return $this;
    }

    public function getCostPaid(): ?int
    {
        return $this->cost_paid;
    }

    public function setCostPaid(int $cost_paid): static
    {
        $this->cost_paid = $cost_paid;

        return $this;
    }

    public function getHint(): ?Hint
    {
        return $this->hint;
    }

    public function setHint(?Hint $hint): static
    {
        $this->hint = $hint;

        return $this;
    }

    public function getPlayer(): ?User
    {
        return $this->player;
    }

    public function setPlayer(?User $player): static
    {
        $this->player = $player;

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
}
