<?php

declare(strict_types=1);

namespace App\Api\House\Request;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    /**
     *
     * @return mixed[]
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->query('name');
    }

    /**
     * @return int|null
     */
    public function getBedrooms(): ?int
    {
        return (int)$this->query('bedrooms');
    }

    /**
     * @return int|null
     */
    public function getBathrooms(): ?int
    {
        return (int)$this->query('bathrooms');
    }

    /**
     * @return int|null
     */
    public function getStoreys(): ?int
    {
        return (int)$this->query('storeys');
    }

    /**
     * @return int|null
     */
    public function getGarages(): ?int
    {
        return (int)$this->query('garages');
    }

    /**
     * @return int|null
     */
    public function getPriceFrom(): ?int
    {
        return (int)$this->query('priceFrom');
    }

    /**
     * @return int|null
     */
    public function getPriceTo(): ?int
    {
        return (int)$this->query('priceTo');
    }
}
