<?php

declare(strict_types=1);

namespace App\Api\House\Resource;

use App\Core\Http\Resource\JsonCollectionResource;

class HouseCollectionResource extends JsonCollectionResource
{
    /**
     * @var string
     */
    protected $resourceClass = HouseResource::class;
}
