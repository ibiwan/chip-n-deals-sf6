<?php

namespace App\Service;

use App\Entity\Chip;
;
use Doctrine\ORM\EntityManagerInterface;

class MutationService
{
  public function __construct(
    private EntityManagerInterface $manager
  ) {
  }

  public function createChip(array $chipDetails): Chip
  {
    $chip = new Chip(
      $chipDetails['color'],
      $chipDetails['value']
    );

    $this->manager->persist($chip);
    $this->manager->flush();

    return $chip;
  }
}