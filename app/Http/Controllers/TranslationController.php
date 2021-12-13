<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TranslationTrait;

class TranslationController extends Controller
{

    public function translation(Request $request)
    {

        $translation = $this->translation($request->translation);

        return response()->json([
            "translation" => $translation
        ]);
    }
}
