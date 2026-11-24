<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $pseudo = null;

    #[ORM\Column(length: 91)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column]
    private ?\DateTime $inscription_date = null;

    #[ORM\Column]
    private ?bool $admin = null;

    #[ORM\Column]
    private ?int $experience = null;

    #[ORM\Column]
    private ?int $money = null;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'player')]
    private Collection $games;

    /**
     * @var Collection<int, UserHint>
     */
    #[ORM\OneToMany(targetEntity: UserHint::class, mappedBy: 'player')]
    private Collection $userHints;

    public function __construct()
    {
        $this->games = new ArrayCollection();
        $this->userHints = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getInscriptionDate(): ?\DateTime
    {
        return $this->inscription_date;
    }

    public function setInscriptionDate(\DateTime $inscription_date): static
    {
        $this->inscription_date = $inscription_date;

        return $this;
    }

    public function isAdmin(): ?bool
    {
        return $this->admin;
    }

    public function setAdmin(bool $admin): static
    {
        $this->admin = $admin;

        return $this;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(int $experience): static
    {
        $this->experience = $experience;

        return $this;
    }

    public function getMoney(): ?int
    {
        return $this->money;
    }

    public function setMoney(int $money): static
    {
        $this->money = $money;

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): static
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->setPlayer($this);
        }

        return $this;
    }

    public function removeGame(Game $game): static
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getPlayer() === $this) {
                $game->setPlayer(null);
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
            $userHint->setPlayer($this);
        }

        return $this;
    }

    public function removeUserHint(UserHint $userHint): static
    {
        if ($this->userHints->removeElement($userHint)) {
            // set the owning side to null (unless already changed)
            if ($userHint->getPlayer() === $this) {
                $userHint->setPlayer(null);
            }
        }

        return $this;
    }
}
