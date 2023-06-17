<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LanguageSwitcherController extends Controller
{
    /**
     * @param Request $request
     * @param string $locale
     * @return RedirectResponse
     */
    public function switcher(Request $request, string $locale): RedirectResponse
    {
        $request->session()->put('locale', $locale);
        return back();
    }
}
