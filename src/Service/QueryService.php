<?php

namespace App\Service;

use App\Entity\Chip;
use App\Repository\ChipRepository;

class QueryService
{
  public function __construct(
    private ChipRepository $chipRepository,
  ) {
  }

  public function findChip(int $chipId): ?Chip
  {
    return $this->chipRepository->find($chipId);
  }

  public function getAllChips(): array
  {
    return $this->chipRepository->findAll();
  }
}
