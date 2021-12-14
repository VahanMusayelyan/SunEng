<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Statickidz\GoogleTranslate;
use App\Enums\Translation;

class TranslationController extends Controller
{

    public function translation(Request $request)
    {
        $validatedData = $request->validate([
            'translate' => ['required'],
        ], [
            'translate.required' => 'The field is empty',
        ]);
        $trans = new GoogleTranslate();
        $source = Translation::EN;
        $target = Translation::RU;

        $result = $trans->translate($source, $target, $request->translate);

        return response()->json([
            "translation" => $result
        ]);
    }
}
