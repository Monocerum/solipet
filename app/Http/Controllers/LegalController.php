<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegalController extends Controller
{
    /**
     * Show the Terms of Service page.
     *
     * @return \Illuminate\View\View
     */
    public function terms()
    {
        return view('legal.terms');
    }

    /**
     * Show the Privacy Policy page.
     *
     * @return \Illuminate\View\View
     */
    public function privacy()
    {
        return view('legal.privacy');
    }
} 