<?php

namespace App\Service;

use App\Entity\Chip;
use App\Entity\Design;
use App\Entity\Player;
use App\Repository\ChipRepository;
use App\Repository\DesignRepository;
use App\Repository\PlayerRepository;

class QueryService
{
  public function __construct(
    private ChipRepository $chipRepository,
    private DesignRepository $designRepository,
    private PlayerRepository $playerRepository,
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

  public function findDesign(int $designId): ?Design
  {
    return $this->designRepository->find($designId);
  }

  public function getAllDesigns(): array
  {
    return $this->designRepository->findAll();
  }

  public function findPlayer(int $playerId): ?Player
  {
    return $this->chipRepository->find($playerId);
  }

  public function getAllPlayers(): array
  {
    return $this->playerRepository->findAll();
  }

  public function getCurrentPlayer(): Player
  {
    return $this->playerRepository->findOneBy([]);
  }
}
