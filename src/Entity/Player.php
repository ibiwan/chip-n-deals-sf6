<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player implements PasswordAuthenticatedUserInterface
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  private ?string $username = null;

  #[ORM\Column(length: 255, nullable: true)]
  private ?string $passhash = null;

  private ?string $password = null;
  public function getPassword(): ?string
  {
    return $this->password;
  }

  #[ORM\Column]
  private ?bool $isAdmin = null;

  #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Design::class)]
  private Collection $designs;

  public function __construct(string $username)
  {
    $this->username = $username;
    $this->designs = new ArrayCollection();
    $this->isAdmin=false;
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getUsername(): ?string
  {
    return $this->username;
  }

  public function setUsername(string $username): static
  {
    $this->username = $username;

    return $this;
  }

  public function getPasshash(): ?string
  {
    return $this->passhash;
  }

  public function setPasshash(?string $passhash): static
  {
    $this->passhash = $passhash;

    return $this;
  }

  public function isIsAdmin(): ?bool
  {
    return $this->isAdmin;
  }

  public function setIsAdmin(bool $isAdmin): static
  {
    $this->isAdmin = $isAdmin;

    return $this;
  }

  /**
   * @return Collection<int, Design>
   */
  public function getDesigns(): Collection
  {
    return $this->designs;
  }

  public function addDesign(Design $design): static
  {
    if (!$this->designs->contains($design)) {
      $this->designs->add($design);
      $design->setOwner($this);
    }

    return $this;
  }

  public function removeDesign(Design $design): static
  {
    if ($this->designs->removeElement($design)) {
      // set the owning side to null (unless already changed)
      if ($design->getOwner() === $this) {
        $design->setOwner(null);
      }
    }

    return $this;
  }
}