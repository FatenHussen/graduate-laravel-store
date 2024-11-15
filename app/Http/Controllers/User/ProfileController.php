<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdatePaswordRequest;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $service;
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function get_profile()
    {
        $res = $this->service->get_profile();
        return $res;
    }

    public function update_profile(UpdateProfileRequest $request)
    {
        $res = $request->validated();
        $id = auth('users')->id();
        $data = $this->service->update_profile($res, $id);
        return $this->sendResponse(__('custom.Success'), data: $data);
    }


    public function update_password(UpdatePaswordRequest $request)
    {
        $res = $request->validated();
        $id = auth('users')->id();
        $data = $this->service->update_password($id,$res);
        return $this->sendResponse(__('custom.Success'), data: $data);
    }
    public function delete_account(Request $request)
    {

        $res = $this->service->delete_account($request);
        return $this->sendResponse(message: __('custom.Success'));

    }

}