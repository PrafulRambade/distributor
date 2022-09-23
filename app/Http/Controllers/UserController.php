<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\Company;
use App\Models\Module;
use App\Models\ModulePermission;
use App\Models\UserRole;
use App\Models\UserrolePermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data['sidebar'] = 'admin';
        $data['users'] = User::with('user_role_details')->get();
        return view("admin.users.index",$data);
    }

    public function create(Request $request)
    {
        $data['sidebar'] = 'master';
        $data['companies'] = Company::where("status",'1')->pluck("name","id");
        $data['user_roles'] = [];
        return view("admin.users.create",$data);
    }

    public function store(Request $request)
    {
        $data = $request->input();
        $data['password'] = Hash::make($data['password']);
        $data['created_by'] = Auth::user()->id;
        $data['updated_by'] = Auth::user()->id;
        $user = new User();
        $user->fill($data);
        $user->save();
        return redirect( 'users' );
    }

    public function edit($id)
    {
        $data['user'] = User::findOrFail($id);
        $data['sidebar'] = 'master';
        $data['companies'] = Company::where("status",'1')->pluck("name","id");
        $data['user_roles'] = UserRole::pluck("name","id");
        return view("admin.users.edit",$data);
    }

    public function update(Request $request)
    {
        $data = $request->input();
        $user_id = $data['user_id'];
        unset($data['_token']);
        unset($data['user_id']);
        if($data['password']){
            $data['password'] = Hash::make($data['password']);
        }
        else{
            unset($data['password']);
        }
        User::where('id',$user_id)->update($data);
        return redirect( 'users' );
    }

    public function delete($id)
    {
        User::find($id)->delete();
        return redirect("users")->with('message', 'User Deleted!');
    }

    public function user_roles(Request $request)
    {
        $data['sidebar'] = 'master';
        // if(Auth::user()->company_id == 0){
        //     $data['user_roles'] = UserRole::where("status",'1')->where("company_id",'>',0)->with('company_details')->get();
        // }
        // else{
            $data['user_roles'] = UserRole::where("status",'1')->get();
        // }
        return view("admin.users.user_roles",$data);
    }

    public function store_user_roles(Request $request)
    {
        $data = $request->input();
        // $data['company_id'] = Auth::user()->company_id;
        // $data['created_by'] = Auth::user()->id;
        // $data['updated_by'] = Auth::user()->id;
        $data['created_by'] = 1;
        $data['updated_by'] = 1;
        if($data['userrole_id'] && $data['userrole_id'] > 0){
            unset($data['_token']);
            $userrole_id = $data['userrole_id'];
            unset($data['userrole_id']);
            UserRole::where("id",$userrole_id)->update($data);
        }
        else{
            $user_role = new UserRole();
            $user_role->fill($data);
            $user_role->save();
        }
        return redirect( 'user_roles' );
    }

    public function user_roles_delete($id)
    {
        UserRole::where("id",$id)->delete();
        return redirect( 'user_roles' )->with('message', 'Userrole Deleted!');
    }

    public function user_roles_edit(Request $request)
    {
        $userrole_id = $request->userrole_id;
        $data['sidebar'] = 'master';
        $data['userrole_id'] = $userrole_id;
        $userrole = UserRole::findOrFail($userrole_id);
        if($userrole){
            $data['userrole_name'] = $userrole['name'];
            $data['status'] = 'success';
        }
        else{
            $data['status'] = 'failure';
        }
        return json_encode($data);
    }

    public function userrole_permissions(Request $request,$id)
    {
        $UserRole = $data['user_role'] = UserRole::find($id);
        $data['sidebar'] = 'master';
        $saved_permissions = UserrolePermission::where("role_id",$id)->pluck("permission_id");
        // dd($saved_permissions);
        if($saved_permissions){
            $saved_permissions = $saved_permissions->toArray();
            $data['saved_permissions'] = $saved_permissions;
        }
        else{
            $data['saved_permissions'] = [];
        }
        $userrole_permissions = ModulePermission::
                                        leftJoin("modules","modules.id","module_permissions.module")
                                        // ->leftJoin("company__modules","company__modules.module_id","modules.id")
                                        // ->where("company__modules.company_id",$UserRole['company_id'])
                                        ->select("modules.name as module","module_permissions.name as permission_name","module_permissions.id as id")
                                        ->orderBy("modules.name","ASC")
                                        ->get();
        if($userrole_permissions){
            foreach ($userrole_permissions as $key => $userrole_permission) {
                $data['userrole_permissions'][$userrole_permission['module']][] = $userrole_permission;
            }
        }          
        // dd($data);         
        return view("admin.users.userrole_permission",$data);
    }

    public function store_userrole_permissions(Request $request)
    {
        $data = $request->input();
        if(is_array($data['permissions']) && count($data['permissions']) > 0){
            //delete the existing records
            UserrolePermission::where("role_id",$data['user_role_id'])->delete();
            foreach ($data['permissions'] as $key => $permission) {
                $temp = array(
                    // "company_id"    => $data['company_id'],
                    "role_id"       => $data['user_role_id'],
                    "permission_id" => $permission,
                    "created_by"    => 1,
                    "updated_by"    => 1
                );
                $userpermission = new UserrolePermission();
                $userpermission->fill($temp);
                $userpermission->save();
            }
        }
        return redirect("user_roles");
    }
}
