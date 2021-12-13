<?php

namespace App\Http\Controllers\Fruit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FruitController extends Controller
{
    public function index(){
        $fruit = DB::table("fruits")->get()->toArray();

        return response()->json($fruit);
    }
}
