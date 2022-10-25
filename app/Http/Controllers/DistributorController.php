<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class DistributorController extends Controller
{
    public function index(){
        return view('distributor.index');
    }
    public function addDistributor(){
        $dealer_id='DL-3';
        $data['all_dist'] = DB::select("CALL fetchDistributorDetails()");
        $data['selected_dealer_distributor'] = DB::select("CALL specificIdDelaerDistributor('".$dealer_id."')");
        // return $data;
        return view('distributor.create',$data);
    }
}
