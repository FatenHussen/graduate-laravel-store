<?php

namespace App\Services;

use App\Models\City;

class CityService extends BaseService
{
    protected $model;

    public function __construct(City $model)
    {
        $this->model = $model;
    }

    public function getAllCities($request)
    {
        $lang = $request->header('Accept-Language') != null ? $request->header('Accept-Language') : 'ar';
        if($lang == 'fr') $lang = 'en';
        return City::select('id', "name_$lang as name")
            ->get();
    }

}