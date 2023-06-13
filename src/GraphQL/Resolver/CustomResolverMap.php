<?php

namespace App\GraphQL\Resolver;

use App\Service\MutationService;
use App\Service\QueryService;
use ArrayObject;
use GraphQL\Type\Definition\ResolveInfo;
use Overblog\GraphQLBundle\Definition\ArgumentInterface;
use Overblog\GraphQLBundle\Resolver\ResolverMap;

class CustomResolverMap extends ResolverMap
{
  public function __construct(
    private QueryService $queryService,
    private MutationService $mutationService
  ) {
  }

  /**
   * @inheritDoc
   */
  protected function map(): array
  {
    return [
      'RootQuery' => [
        self::RESOLVE_FIELD => function ($value, ArgumentInterface $args, ArrayObject $context, ResolveInfo $info) {
          return match ($info->fieldName) {
            'chip' => $this->queryService->findChip((int) $args['id']),
            'chips' => $this->queryService->getAllChips(),
            'design' => $this->queryService->findDesign((int) $args['id']),
            'designs' => $this->queryService->getAllDesigns(),
            'player' => $this->queryService->findPlayer((int) $args['id']),
            'players' => $this->queryService->getAllPlayers(),
            'currentPlayer' => $this->queryService->getCurrentPlayer(),
            default => null,
          };
        },
      ],
      'RootMutation' => [
        self::RESOLVE_FIELD => function ($value, ArgumentInterface $args, ArrayObject $context, ResolveInfo $info) {
          return match ($info->fieldName) {
            'createChip' => $this->mutationService->createChip($args['chip']),
            'createDesign' => $this->mutationService->createDesign($args['design']),
            'createPlayer' => $this->mutationService->createPlayer($args['player']),
            default => null
          };
        },
      ],
    ];
  }
}