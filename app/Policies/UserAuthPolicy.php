<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PermissionRole;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserAuthPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public static function isAdmin($user)
    {
        
        if ($user->user_role == 1) {return true;}return false;
    }

    public static function isUser($user)
    {
        if ($user->user_role == 2) {return true;}return false;
    }

    public static function contorllerAccess($user)
    {
        $actionName = class_basename(Route::current()->getActionName());
        $actionNamearr = explode('@', $actionName);

        $is_exist =  PermissionRole::join('permissions', 'permissions.id', 'permission_role.permission_id')
                        ->where('permission_role.role_id',$user->user_role)
                        ->where('permissions.controller','=',$actionNamearr[0])
                        ->where('permissions.method','=',$actionNamearr[1])
                        ->count();

        // check if requested action is in permissions list
        if($is_exist > 0){
            return true;
        }

        // none authorized request
        return false;
    }
}
