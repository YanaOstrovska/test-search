<?php

declare(strict_types=1);

namespace App\Core\Http\Resource;

abstract class JsonCollectionResource extends JsonResource
{
    /**
     * @var string
     */
    protected $resourceClass;

    /**
     * @var mixed[]
     */
    private $resource;

    /**
     * @param mixed[] $resource
     */
    public function __construct(array $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @return \App\Core\Http\Resource\JsonResource[]
     */
    public function toArray(): array
    {
        return array_map(function ($resource) {
            return new $this->resourceClass($resource);
        }, $this->resource);
    }
}
