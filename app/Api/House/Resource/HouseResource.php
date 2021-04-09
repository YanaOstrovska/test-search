<?php

declare(strict_types=1);

namespace App\Api\House\Resource;

use App\Core\Http\Resource\JsonResource;
use App\Domains\House\House;

class HouseResource extends JsonResource
{
    /**
     * @var House
     */
    private $house;

    /**
     * HouseResource constructor.
     * @param House $house
     */
    public function __construct(House $house)
    {
        $this->house = $house;
    }

    /**
     *
     * @return array<mixed>
     */
    public function toArray(): array
    {
        return [
            'name' => $this->house->name,
            'price' => $this->getPrice(),
            'countBedrooms' => $this->house->count_bedrooms,
            'countBathrooms' => $this->house->count_bathrooms,
            'countStoreys' => $this->house->count_storeys,
            'countGarages' => $this->house->count_garages,
        ];
    }

    /**
     * @return string
     */
    private function getPrice(): string
    {
        return number_format( $this->house->price, 2, ',', '.');

    }

}
