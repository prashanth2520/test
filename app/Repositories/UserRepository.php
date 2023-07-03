<?php 
namespace App\Repositories;
use App\Models\User;
use App\Models\Routedirection;
use App\Models\EmployeeDetails;
use App\Models\Record;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function updateProfile($data){

        try{
            $user = User::where('id', Auth::user()->id)->first();

            $phoneNumber = EmployeeDetails::where('user_id', $user->id)->first();

            $input = $data->all();
            $rules = [
                'name' => 'required|string',
                'email' => 'required|email',
                'phoneno' => 'required|numeric|digits:10',
                'address' => 'required|string',
            ];
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first(),
                ], 400);
            }
            
            $user->Update([
                "name" => $input['name'],
                "email" => $input['email'],
                "address" => $input['address'],
            ]);

            //update phone number
           
            $phoneNumber->Update([
                "phone" =>  $input['phoneno'],
            ]);
  
            return response()->json([
                'status' => true,
                'message' => 'User Updated SuccessFully.',
                'data' => $user,
                'phone' => $phoneNumber->phone,
            ],200);
        }catch(\Exception $e){
            Log::error([
                "function"  => "updateProfile",
                "error"     => $e->getMessage(),
                "line"      => $e->getLine(),
                "trace"     => $e->getTraceAsString()
            ]);
            return response()->json(['status' => false, 'message' => 'Something Went Wrong'], 400);
        }
    }

    public function login($data){
        try{
            $credentials = $data->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('user')->accessToken;

                return response()->json([
                    'token' => $token,
                    'status' => true,
                    'message' => 'Successfully Logged in.',
                    'data' => $user,
                ],200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid credentials.',
                ],400);
            }
        }catch(\Exception $e){
            Log::error([
                "function"  => "login",
                "error"     => $e->getMessage(),
                "line"      => $e->getLine(),
                "trace"     => $e->getTraceAsString()
            ]);
            return response()->json(['status' => false, 'message' => 'Something Went Wrong'], 400);
        }
    }

    public function forgotPassword($data){
        try{
            $input = $data->all();
            $rules = [
                'email' => 'required|email',
            ];
            
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first(),
                ],400);
            }

            $response = Password::sendResetLink($data->only('email'));

            if ($response == Password::RESET_LINK_SENT) {
                return response()->json([
                    'status' => true,
                    'message' => trans($response),
                ],200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => trans($response),
                ],400);
            }
        }catch(\Exception $e){
            Log::error([
                "function"  => "forgotPassword",
                "error"     => $e->getMessage(),
                "line"      => $e->getLine(),
                "trace"     => $e->getTraceAsString()
            ]);
            return response()->json(['status' => false, 'message' => 'Something Went Wrong'], 400);
        }
    }

    public function changePassword($data)
    {
        try{
            $input = $data->all();
            $rules = [
                'new_password' => 'required',
                'confirm_password' => 'required|same:new_password',
            ];
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first(),
                ],400);
            }

            $user = Auth::user();
            $user->password = bcrypt($input['new_password']);
            $user->save();
            return response()->json([
                'status' => true,
                'message' => 'Password Changed Successfully.',
            ],200);

            
        }catch(\Exception $e){
            Log::error([
                "function"  => "changePassword",
                "error"     => $e->getMessage(),
                "line"      => $e->getLine(),
                "trace"     => $e->getTraceAsString()
            ]);
            return response()->json(['status' => false, 'message' => 'Something Went Wrong'], 400);
        }
    }

    public function home()
    {
        try{
            $user = Auth::user();
            
            $user['role'] = UserRole::where('id', $user->user_role)->select('role')->first()->role;

            $routes_count = Routedirection::count(); //routes count

            $recent_routes = Record::with('getRouteAssessmentFormPdf','getDirectionFormPdf','recordType')
            
                            ->where('created_by', Auth::user()->id)
                            ->where(function ($query) {
                                $query->whereHas('recordType', function ($query) {
                                        $query->where('record_type', 'Direction');
                                    })
                                    ->orWhereHas('recordType', function ($query) {
                                        $query->where('record_type', 'Both');
                                    });
                            })
                            ->take(4)
                            ->orderBy('created_at', 'desc')
                            ->get();

            
       
                
            return response()->json([
                'status' => true,
                'data' => $user,
                'routes_count' => $routes_count,
                'recent_routes' => $recent_routes,
            ],200);
        }catch(\Exception $e){
            Log::error([
                "function"  => "home",
                "error"     => $e->getMessage(),
                "line"      => $e->getLine(),
                "trace"     => $e->getTraceAsString()
            ]);
            return response()->json(['status' => false, 'message' => 'Something Went Wrong'], 400);
        }
    }
    
    public function getProfile(){
        try{
            $user = User::where('id', Auth::user()->id)->first();

            $user->phoneno = EmployeeDetails::where('user_id', $user->id)->first()->phone;

            return response()->json([
                'status' => true,
                'data' => $user,
            ],200);

        }catch(\Exception $e){
            Log::error([
                "function"  => "getProfile",
                "error"     => $e->getMessage(),
                "line"      => $e->getLine(),
                "trace"     => $e->getTraceAsString()
            ]);
            return response()->json(['status' => false, 'message' => 'Something Went Wrong'], 400);
        }
    }

    public function createGroup($data){
        try{
            
        }catch(\Exception $e){
            Log::error([
                "function"  => "createGroup",
                "error"     => $e->getMessage(),
                "line"      => $e->getLine(),
                "trace"     => $e->getTraceAsString()
            ]);
            return response()->json(['status' => false, 'message' => 'Something Went Wrong'], 400);
        }
    }
}