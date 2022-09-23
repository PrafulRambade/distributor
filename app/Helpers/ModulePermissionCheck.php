<?php

namespace App\Helpers;
use App\Models\Admin\UserrolePermission;
use Illuminate\Support\Facades\Auth;

class ModulePermissionCheck
{
	function isPermitted($permission_id){
		$is_permission = UserrolePermission::where("company_id",Auth::user()->company_id)
											->where("role_id",Auth::user()->user_role)
											->where("permission_id",$permission_id)
											->pluck('id','id');
		if($is_permission && count($is_permission) > 0){
			return true;
		}
		else{
			return false;
		}
	}

}