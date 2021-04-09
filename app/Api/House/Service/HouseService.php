<?php

declare(strict_types=1);

namespace App\Api\House\Service;


use App\Api\House\Request\SearchRequest;
use App\Api\House\Resource\HouseCollectionResource;
use App\Domains\House\House;

class HouseService
{
    /**
     * @param SearchRequest $request
     * @return HouseCollectionResource
     */
    public function getSearch(SearchRequest $request): HouseCollectionResource
    {
        $query = House::query();

        $name = $request->getName();
        $bedrooms = $request->getBedrooms();
        $bathrooms = $request->getBathrooms();
        $storeys = $request->getStoreys();
        $garages = $request->getGarages();
        $priceFrom = $request->getPriceFrom();
        $priceTo = $request->getPriceTo();

        if ($name) {
            $query->where('name', 'like', "%$name%");
        }

        if ($bedrooms) {
            $query->where('count_bedrooms', $bedrooms);
        }

        if ($bathrooms) {
            $query->where('count_bathrooms', $bathrooms);
        }

        if ($storeys) {
            $query->where('count_storeys', $storeys);
        }

        if ($garages) {
            $query->where('count_garages', $garages);
        }

        if ($priceFrom && $priceTo) {
            $query->whereBetween('price', [$priceFrom, $priceTo]);
        }

        $houses = $query->get()->all();

        return new HouseCollectionResource($houses);
    }

}
