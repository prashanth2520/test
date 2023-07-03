<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Services\Interfaces\SettingServiceInterface;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class SettingService implements SettingServiceInterface
{

    public function changePassword(array $request)
    {
        $result = 0;
        try {
            return User::where('id',  Auth::user()->id)->update([
                'password' =>  Hash::make($request['password'])
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $result;
        }
    }
}
