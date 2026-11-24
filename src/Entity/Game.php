<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $game_date = null;

    #[ORM\Column]
    private ?int $number_try = null;

    #[ORM\Column]
    private ?int $score = null;

    #[ORM\Column]
    private ?bool $victory = null;

    #[ORM\Column(length: 50)]
    private ?string $difficulty = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $player = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Mode $mode = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pokemon $pokemon = null;

    /**
     * @var Collection<int, Proposition>
     */
    #[ORM\OneToMany(targetEntity: Proposition::class, mappedBy: 'game')]
    private Collection $propositions;

    /**
     * @var Collection<int, UserHint>
     */
    #[ORM\OneToMany(targetEntity: UserHint::class, mappedBy: 'game')]
    private Collection $userHints;

    public function __construct()
    {
        $this->propositions = new ArrayCollection();
        $this->userHints = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGameDate(): ?\DateTime
    {
        return $this->game_date;
    }

    public function setGameDate(\DateTime $game_date): static
    {
        $this->game_date = $game_date;

        return $this;
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

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): static
    {
        $this->score = $score;

        return $this;
    }

    public function isVictory(): ?bool
    {
        return $this->victory;
    }

    public function setVictory(bool $victory): static
    {
        $this->victory = $victory;

        return $this;
    }

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): static
    {
        $this->difficulty = $difficulty;

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

    public function getMode(): ?Mode
    {
        return $this->mode;
    }

    public function setMode(?Mode $mode): static
    {
        $this->mode = $mode;

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

    /**
     * @return Collection<int, Proposition>
     */
    public function getPropositions(): Collection
    {
        return $this->propositions;
    }

    public function addProposition(Proposition $proposition): static
    {
        if (!$this->propositions->contains($proposition)) {
            $this->propositions->add($proposition);
            $proposition->setGame($this);
        }

        return $this;
    }

    public function removeProposition(Proposition $proposition): static
    {
        if ($this->propositions->removeElement($proposition)) {
            // set the owning side to null (unless already changed)
            if ($proposition->getGame() === $this) {
                $proposition->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserHint>
     */
    public function getUserHints(): Collection
    {
        return $this->userHints;
    }

    public function addUserHint(UserHint $userHint): static
    {
        if (!$this->userHints->contains($userHint)) {
            $this->userHints->add($userHint);
            $userHint->setGame($this);
        }

        return $this;
    }

    public function removeUserHint(UserHint $userHint): static
    {
        if ($this->userHints->removeElement($userHint)) {
            // set the owning side to null (unless already changed)
            if ($userHint->getGame() === $this) {
                $userHint->setGame(null);
            }
        }

        return $this;
    }
}
