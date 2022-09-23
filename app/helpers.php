<?php 

use App\Models\Admin\UserrolePermission;
use Illuminate\Support\Facades\Auth;

function isPermitted($permission_id){
	$is_permission = UserrolePermission::where("company_id",Auth::user()->company_id)
										->where("role_id",Auth::user()->user_role)
										->where("permission_id",$permission_id)
										->pluck('id');
	if($is_permission && is_array($is_permission) && $is_permission[0]){
		return "here";
	}
	else{
		return "here too";
	}
}
