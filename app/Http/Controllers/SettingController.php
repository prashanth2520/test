<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests\PasswordRequest;
use App\Services\SettingService;

class SettingController extends Controller
{
    private $settingService;
    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }


    public function profileView()
    {
        return view('settings.profileview')->with(['sideMenu' => 'settings']);
    }

    public function changePassword(PasswordRequest $request)
    {
        try {
            $save = 0;
            $save = $this->settingService->changePassword($request->all());
            if ($save > 0) {
                return redirect('profile')->with('success', 'Updated successfully.');
            } else {
                return redirect('profile')->with('error', 'Something went wrong.... Please try again later.');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('profile')->with('error', 'Something went wrong.... Please try again later.');
        }
    }
}
