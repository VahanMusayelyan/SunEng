<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
{
    public function index(StoreRequest $request)
    {

        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::where("email", $data['email'])->first();
        if ($user) return response(['msg' => "This email is exist"]);
        $newUser = User::create($data);

        $token = auth()->tokenById($newUser->id);

        return response(['access_token' => $token]);
    }
}
