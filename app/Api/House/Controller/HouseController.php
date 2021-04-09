<?php

declare(strict_types=1);

namespace App\Api\House\Controller;

use App\Api\House\Request\SearchRequest;
use App\Api\House\Service\HouseService;
use App\Core\Http\Response\Api\v1\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Responsable;

class HouseController extends Controller
{

    /**
     * @var HouseService
     */
    private $service;

    public function __construct(HouseService $service)
    {
        $this->service = $service;
    }

    /**
     * @param SearchRequest $request
     * @return Responsable
     */
    public function search(SearchRequest $request): Responsable
    {
        $result = $this->service->getSearch($request);

        return JsonResponse::resource($result);
    }
}
