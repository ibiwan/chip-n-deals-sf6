<?php

namespace App\Service;

use App\Entity\Chip;

;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Design;
use App\Entity\Player;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Repository\PlayerRepository;

class MutationService
{
  public function __construct(
    private EntityManagerInterface $manager,
    private UserPasswordHasherInterface $passwordHasher,
    private PlayerRepository $playerRepository,
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

  public function createDesign(array $designDetails): Design
  {
    $player = $this->playerRepository->findOneBy([]);

    $design = new Design(
      $designDetails['name'],
    );
    $design->setOwner($player);
    $this->manager->persist($design);
    $this->manager->flush();

    foreach ($designDetails['chips'] as $chipData) {
      // $chip = $this->createChip($chipData);
      $chip = new Chip($chipData['color'], $chipData['value']);
      // var_dump($design);
      $chip->setDesign($design);
      $this->manager->persist($chip);
      $this->manager->flush();

      $design->addChip($chip);
    }
    $this->manager->flush();

    return $design;
  }

  public function createPlayer(array $playerDetails): Player
  {
    $player = new Player($playerDetails['username']);
    $plaintextPassword = $playerDetails['password'];
    $hashedPassword = $this->passwordHasher->hashPassword(
      $player,
      $plaintextPassword
    );
    $player->setPasshash($hashedPassword);

    $this->manager->persist($player);
    $this->manager->flush();

    return $player;
  }


}