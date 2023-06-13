<?php

namespace App\Entity;

use App\Repository\DesignRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DesignRepository::class)]
class Design
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'designs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Player $owner = null;

    #[ORM\OneToMany(mappedBy: 'design', targetEntity: Chip::class, orphanRemoval: true)]
    private Collection $chips;

    public function __construct(
      string $name
    ) {
      $this->name = $name;
      $this->chips = new ArrayCollection();
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

    public function getOwner(): ?Player
    {
        return $this->owner;
    }

    public function setOwner(?Player $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection<int, Chip>
     */
    public function getChips(): Collection
    {
        return $this->chips;
    }

    public function addChip(Chip $chip): static
    {
        if (!$this->chips->contains($chip)) {
            $this->chips->add($chip);
            $chip->setDesign($this);
        }

        return $this;
    }

    public function removeChip(Chip $chip): static
    {
        if ($this->chips->removeElement($chip)) {
            // set the owning side to null (unless already changed)
            if ($chip->getDesign() === $this) {
                $chip->setDesign(null);
            }
        }

        return $this;
    }
}
