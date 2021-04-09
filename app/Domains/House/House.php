<?php

/** @noinspection PhpMissingFieldTypeInspection */

declare(strict_types=1);

namespace App\Domains\House;

use App\Domains\House\Eloquent\HouseQueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @property-read int $id
 * @property string $name
 * @property int $price
 * @property int $count_bedrooms
 * @property int $count_bathrooms
 * @property int $count_storeys
 * @property int $count_garages
 */
class House extends Model
{
    /**
     * @return HouseQueryBuilder
     * @noinspection PhpIncompatibleReturnTypeInspection
     */
    public static function query(): HouseQueryBuilder
    {
        /**
         * @phpstan-ignore-next-line
         */
        return parent::query();
    }

    /**
     * @param Builder $query
     *
     * @return HouseQueryBuilder
     */
    public function newEloquentBuilder($query): HouseQueryBuilder
    {
        return new HouseQueryBuilder($query);
    }
}
