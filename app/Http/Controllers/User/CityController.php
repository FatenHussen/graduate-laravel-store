<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\CityService;
use Illuminate\Http\Request;

class CityController extends Controller
{
    protected $service;
    public function __construct(CityService $service)
    {
        $this->service = $service;
    }

    public function all_cities(Request $request)
    {
        $res = $this->service->getAllCities($request);
        return $this->sendResponse(__('custom.Success'), data: $res);
    }
}