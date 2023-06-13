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
            default => null
          };
        },
      ],
      'RootMutation' => [
        self::RESOLVE_FIELD => function ($value, ArgumentInterface $args, ArrayObject $context, ResolveInfo $info) {
          return match ($info->fieldName) {
            'createChip' => $this->mutationService->createChip($args['chip']),
            default => null
          };
        },
      ],
    ];
  }
}