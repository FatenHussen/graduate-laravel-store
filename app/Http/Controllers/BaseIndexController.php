<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

abstract class BaseIndexController extends BaseController
{
    protected $service;
    protected $filterRequest;

    protected function index(Request $request)
    {
        // If there's a filter request, apply validated filters
        $filters = $this->filterRequest ? app($this->filterRequest)->validated() : [];
        $res = $this->service->getAll($filters);
        
        return $this->sendResponse(data: $res, message: __('custom.Success'));
    }
    protected function show($id)
    {
        $res = $this->service->getOne($id);
        return $this->sendResponse(data: $res, message: __('custom.Success'));
    }

    protected function get_one($id)
    {
        $res = $this->service->getOne($id);
        return $this->sendResponse(data: $res, message: __('custom.Success'));
    }

    protected function sendResponse($data, $message = '', $code = 200)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $code);
    }
}
