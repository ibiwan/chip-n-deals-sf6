<?php

namespace App\Entity;

use App\Repository\ChipRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChipRepository::class)]
class Chip
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  private string $color;

  #[ORM\Column]
  private int $value;

  #[ORM\ManyToOne(inversedBy: 'chips')]
  #[ORM\JoinColumn(nullable: false)]
  private ?Design $design = null;

  public function __construct(
    string $color,
    int $value
  ) {
    $this->color = $color;
    $this->value = $value;
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getColor(): ?string
  {
    return $this->color;
  }

  public function setColor(string $color): static
  {
    $this->color = $color;

    return $this;
  }

  public function getValue(): ?int
  {
    return $this->value;
  }

  public function setValue(int $value): static
  {
    $this->value = $value;

    return $this;
  }

  public function getDesign(): ?Design
  {
      return $this->design;
  }

  public function setDesign(?Design $design): static
  {
      $this->design = $design;

      return $this;
  }
}