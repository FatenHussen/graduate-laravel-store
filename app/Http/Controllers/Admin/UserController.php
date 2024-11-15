<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\BaseException;
use App\Http\Controllers\BaseCRUDController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Services\TestService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends BaseCRUDController
{
    public function __construct(UserService $service)
    {
        $this->service = $service;
        // $this->createRequest = CreateUserRequest::class;
        // $this->updateRequest = UpdateUserRequest::class;
        // $this ->filterRequest = FilterRequest::class;
        // you can change comment for any controller you want
    }


}
