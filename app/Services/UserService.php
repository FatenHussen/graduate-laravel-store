<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\OtpMail;
use App\Models\Device;
use App\Traits\FileTrait;
use App\Mail\PasswordMail;
use App\Models\PrintSetting;
use App\Models\Verification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Exceptions\NotFoundException;
use App\Exceptions\UnAuthorizedException;
use App\Exceptions\VerificationException;
use App\Exceptions\CustomExceptionWithMessage;

class UserService extends BaseService
{
    use FileTrait;
    public $model;
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function register($request)
    {
        $user_info = $request->validated();
        $user = User::create([
            'name' => $user_info['name'],
            'email' => $user_info['email'],
            'password' => $user_info['password'],
            // 'city_id' => $user_info['city_id'],
        ]);
        $this->sendOtp($user->id);
        return true;
    }

    public function login($request)
    {
        $login_info = $request->validated();

        $user = User::where('email', $login_info['email'])->first();
        if (!Hash::check($login_info['password'], $user->password)) {
            throw new CustomExceptionWithMessage('wrong_credential');
        }

        if ($user->is_blocked == 1) {
            throw new UnAuthorizedException();
        }
        if ($user->email_verified_at == null) {
            $this->sendOtp($user->id);
            throw new VerificationException();
        } else {
            $token = $user->createToken('AUTH')->plainTextToken;
            $user->makeHidden(['device']);
            $res['user'] = $user;
            $res['token'] = $token;
            return $res;
        }
    }

    public function sendOtp($id)
    {
        $user = User::findOrFail($id);

        if ($user->email_verified_at == null) {

            $otp = rand(100000, 999999);
            $ver = Verification::create([
                'code' => $otp,
                'user_id' => $user->id,
                'end_at' => Carbon::now()->addMinutes(15),
            ]);
            Mail::to($user->email)->send(new OtpMail($user, $otp, $ver->end_at));
            return true;
        } else {
            throw new CustomExceptionWithMessage('already_otp');
        }
    }

    public function verifyOtp($request)
    {
        $user = User::where('email', $request->email)->first();
        $otpIsValid = Verification::
            where('user_id', $user->id)
            ->where('code', $request->code)
            ->where('end_at', '>', Carbon::now())
            ->where('type', 'verification')
            ->where('verified_at', null)
            ->first();
        if (!$otpIsValid) {
            throw new CustomExceptionWithMessage('Otp_valid');
        }
        $user->email_verified_at = Carbon::now();
        $user->save();
        $otpIsValid->verified_at = Carbon::now();
        $otpIsValid->save();

        $token = $user->createToken('AUTH')->plainTextToken;

        $res['user'] = $user;
        $res['token'] = $token;
        return $res;
    }
    public function sendPassword($id)
    {
        $user = User::findOrFail($id);

        $password = rand(100000, 999999);
        $ver = Verification::create([
            'code' => $password,
            'user_id' => $user->id,
            'type' => 'reset_password',
            'end_at' => Carbon::now()->addMinutes(10),
        ]);
        Mail::to($user->email)->send(new PasswordMail($user, $password, $ver->end_at));
        return true;
    }
    public function verifyPassword($request)
    {
        $user = User::where('email', $request->email)->first();

        $passwordIsValid = Verification::
            where('user_id', $user->id)
            ->where('code', $request->code)
            ->where('end_at', '>', Carbon::now())
            ->where('type', 'reset_password')
            ->first();
        if (!$passwordIsValid) {
            throw new CustomExceptionWithMessage('password_valid');
        }

        $token = $user->createToken('AUTH', ['reset-password'])->plainTextToken;

        $res['user'] = $user;
        $res['token'] = $token;
        return $res;
    }
    public function reset_password($id, $new_password)
    {
        $user = User::find($id);
        if ($user) {
            $new_password = Hash::make($new_password);
            $user->password = $new_password;
            $user->save();
            auth()->user()->tokens()->delete();
            $token = $user->createToken('AUTH')->plainTextToken;
            $res['user'] = $user;
            $res['token'] = $token;
            return $res;
        } else {
            return new NotFoundException();
        }

    }

    public function get_profile()
    {
        return auth('users')->user();
    }

    public function update_profile($data, $id)
    {

        $result = User::find($id);
        if ($result) {
            if (isset($data['image'])) {
                $this->deleteFile("", $result->image);
                $path = $this->uploadFile("", $data['image']);
                $data['image'] = $path;
            }
            $result->update([
                'name' => $data['name'],
                'city_id' => $data['city_id'],
                'image' => $data['image'] ?? $result->image,
            ]);
            return $result;
        }
        return new NotFoundException();
    }
    public static function logout($request)
    {
        auth()->user()->tokens()->delete();
        return true;
    }

    public function update_password($id, $request)
    {

        $user = User::findOrFail($id);
        if (!Hash::check($request['old_password'], $user->password)) {
            throw new CustomExceptionWithMessage('wrong_password');
        } else {
            $user['password'] = $request['new_password'];
            $user->save();
            return true;
        }
    }
    public function delete_account($request)
    {
        $user = auth('users')->id();
        $delete = User::where('id', $user)->first();
        $delete->delete();
        return true;
    }
}