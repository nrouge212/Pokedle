<?php

namespace App\Entity;

use App\Repository\HintRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HintRepository::class)]
class Hint
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $cost = null;

    #[ORM\Column(length: 50)]
    private ?string $type_hint = null;

    /**
     * @var Collection<int, UserHint>
     */
    #[ORM\OneToMany(targetEntity: UserHint::class, mappedBy: 'hint')]
    private Collection $userHints;

    public function __construct()
    {
        $this->userHints = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCost(): ?int
    {
        return $this->cost;
    }

    public function setCost(int $cost): static
    {
        $this->cost = $cost;

        return $this;
    }

    public function getTypeHint(): ?string
    {
        return $this->type_hint;
    }

    public function setTypeHint(string $type_hint): static
    {
        $this->type_hint = $type_hint;

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
            $userHint->setHint($this);
        }

        return $this;
    }

    public function removeUserHint(UserHint $userHint): static
    {
        if ($this->userHints->removeElement($userHint)) {
            // set the owning side to null (unless already changed)
            if ($userHint->getHint() === $this) {
                $userHint->setHint(null);
            }
        }

        return $this;
    }
}
