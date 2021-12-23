<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function contactUs(Request $request){
        $request->validate([
            "email" => "required|email",
            "message" => "required",
        ]);

        DB::table("contact_us")->insert([
            "email"   => $request->email,
            "message" => $request->message,
        ]);

        return redirect()->back()->withErrors(['msg' => "Your message sent"]);
    }
}
