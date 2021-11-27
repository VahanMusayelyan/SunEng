<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class TestController extends Controller
{
    public function controllerMethod()
    {

        return response()->json([
            'msg' => 'We should return only json'
        ]);

    }

    public function test(Request $request)
    {
        $inserted = Tag::insert([
            "tagName" => $request->tagName
        ]);
        if($inserted){
            return response()->json([
                'msg' => 'Tha tag has succesful inserted'
            ]);
        }

        return response()->json([
            'msg' => 'Something went wrong'
        ], 200);

    }

}
