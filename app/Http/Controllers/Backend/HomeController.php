<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

class HomeController extends BackendController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (view()->exists('backend.home')) {
            return view('backend.home');
        }
    }
}