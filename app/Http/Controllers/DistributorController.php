<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DistributorController extends Controller
{
    public function index(){
        return view('distributor.index');
    }
    public function addDistributor(){
        return view('distributor.create');
    }
}
