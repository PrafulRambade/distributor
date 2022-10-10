<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\UserRole;

class HomeController extends Controller
{
    public function index()
    {
        $id=2;
        // $single_blog['user'] = UserRole::where('id',$id)->get();
        $single_blog = DB::select("CALL FetchUserRoleWithId(".$id.")");

        // dd($single_blog);
        return view('home')->with('store', $single_blog); ;
    }
}
