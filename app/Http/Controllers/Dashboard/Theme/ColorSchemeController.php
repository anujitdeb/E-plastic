<?php

namespace App\Http\Controllers\Dashboard\Theme;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ColorSchemeController extends Controller
{
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function switch(Request $request)
    {
        session([
            'color_scheme' => $request->color_scheme
        ]);

        return back();
    }
}
