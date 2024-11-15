<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ResetPasswordRequest;
use App\Http\Requests\User\SendOtpRequest;
use App\Http\Requests\User\SendPasswordRequest;
use App\Http\Requests\User\UserLoginRequest;
use App\Http\Requests\User\UserRegisterRequest;
use App\Http\Requests\User\VerifyOtpRequest;
use App\Http\Requests\User\VerifyPasswordRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $service;
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
    public function register(UserRegisterRequest $request)
    {
        $res = $this->service->register($request);
        return $this->sendResponse(message:__('custom.Success'));
    }

    public function verify_otp(VerifyOtpRequest $request)
    {
        $res = $this->service->verifyOtp($request);
        return $this->sendResponse(__('custom.Success'), data: $res);
    }

    public function send_otp(SendOtpRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        $res = $this->service->sendOtp($user->id);
        if ($res == true) {
            return $this->sendResponse(__('custom.Success'), data: $res);
        }
        return $this->sendError(message: __('custom.Error'));
    }

    public function login(UserLoginRequest $request)
    {
        $data = $request->validated();
        $res = $this->service->login($request);
        return $this->sendResponse(__('custom.Success'), data: $res);
    }
    public function send_password(SendPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        $res = $this->service->sendPassword($user->id);
        if ($res == true) {
            return $this->sendResponse(__('custom.Success'), data: $res);
        }
        return $this->sendError(message: __('custom.Error'));
    }

    public function reset_password(ResetPasswordRequest $request)
    {
        $password = $request->validated();
        $new_password = $request['new_password'];
        $user = auth('users')->id();
       $res = $this->service->reset_password($user,$new_password);
        if ($res == true) {
            return $this->sendResponse(__('custom.Success'), data: $res);
        }
        return $this->sendError(message: __('custom.Error'));
    }
    public function verify_password(VerifyPasswordRequest $request)
    {
        $res = $this->service->verifyPassword($request);
        return $this->sendResponse(__('custom.Success'), data: $res);
    }

    public function logout(Request $request)
    {

        $res = $this->service->logout($request);
        return $this->sendResponse(message: __('custom.Success'));

    }

}