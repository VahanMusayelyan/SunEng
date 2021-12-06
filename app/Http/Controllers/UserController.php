<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function checkUsername(Request $request){
        $this->validate($request, [
            "email" => "required",
        ]);
        $user = User::where("email", $request->email)->first();
        if($user){
            return response()->json([
                'user' => $user->email
            ]);
        }
        return response()->json([
            'user' => null
        ]);
    }

    public function checkPhone(Request $request){
        $this->validate($request, [
            "phone" => "required",
        ]);
        $user = User::where("phone", $request->phone)->first();
        if($user){
            return response()->json([
                'phone' => $user->phone
            ]);
        }
        return response()->json([
            'phone' => null
        ]);
    }

    public function register(Request $request){
        $this->validate($request, [
            'name'      => 'required',
            'surname'   => 'required',
            'phone'     => 'required',
            'email'     => 'required|unique:users|max:255',
            'password'  => 'required',
            'password_confirmation'  => 'required',
        ]);

        if($request->password !== $request->password_confirmation){
            return response()->json([
               "msg" => 0
            ]);
        }
        User::insert([
            'name'      => $request->name,
            'surname'   => $request->surname,
            'phone'     => $request->phone,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),

        ]);

        return response()->json([
            "msg" => "done"
        ]);
    }
}
