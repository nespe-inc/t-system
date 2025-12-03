<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class MasterController extends Controller
{
    /**
     * Display the master management page.
     */
    public function index(): View
    {
        return view('masters.index');
    }
}

