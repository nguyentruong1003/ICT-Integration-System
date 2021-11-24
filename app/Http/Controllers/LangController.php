<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangController extends Controller
{
    //
    private $langActive = [
        'vi',
        'en',
    ];

    public function changeLang(Request $request, $lang)
    {
        if (in_array($lang, $this->langActive)) {
            session(['locale' => $lang]);
            return redirect()->back();
        }
    }
}
