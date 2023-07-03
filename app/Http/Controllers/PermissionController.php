<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\PermissionRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class PermissionController extends Controller
{
    public function index(){
        $all_routes = $this->store_all_routes();
        return view('permission.view', compact('all_routes'));
    }

    public function store_all_routes(){
        $route_array = array();
        $routeCollection = Route::getRoutes();
        foreach($routeCollection as $route){
            $prefix = $route->getPrefix();
            $actionName = class_basename($route->getActionName());
            $has_admin_access = 0; $has_user_access = 0;
            if( $prefix != "_ignition" && $actionName != "Closure"){
                $actionNamearr = explode('@', $actionName);
                $permission_query = Permission::where('controller','=',$actionNamearr[0])
                                    ->where('method','=',$actionNamearr[1])
                                    ->where('prefix','=',$prefix);
                $has_permission = $permission_query->count();
                if($has_permission == 0){
                    $permission = new Permission;
                    $permission->controller=$actionNamearr[0];
                    $permission->method=$actionNamearr[1];
                    $permission->prefix=$prefix;
                    $permission->save();

                    $permission_id=$permission->id;
                }else{
                    $permission = $permission_query->first();
                    $has_admin_access = PermissionRole::join('permissions', 'permissions.id', 'permission_role.permission_id')
                                        ->where('permission_role.permission_id',$permission['id'])
                                        ->where('permission_role.role_id',1)
                                        ->count();
                    $has_user_access = PermissionRole::join('permissions', 'permissions.id', 'permission_role.permission_id')
                                        ->where('permission_role.permission_id',$permission['id'])
                                        ->where('permission_role.role_id',2)
                                        ->count();
                    $permission_id=$permission->id;
                }
                $route_array[] = array( 'prefix'=>$prefix, 'controller'=>$actionNamearr[0], 'method'=>$actionNamearr[1], 'has_admin_access'=> $has_admin_access, 'has_user_access' => $has_user_access, 'permission_id' => $permission_id  ) ;
            }
        }
        return $route_array;
    }

    public function savePermission(Request $request){
        $response = array();
        $has_access =  PermissionRole::where('permission_id', $request['permission_id'])->where('role_id', $request['user_role'])->count();
        if($has_access > 0){

            $delete_access =   PermissionRole::where('permission_id', $request['permission_id'])->where('role_id', $request['user_role'])->delete();

        }else{
            $permission_role = new PermissionRole;
            $permission_role->permission_id = $request['permission_id'];
            $permission_role->role_id = $request['user_role'];
            $permission_role->save();
        }
        $response['data'] = $request->all();
        $response['status'] = 'Success';
        return response()->json($response);
    }
}
