<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function parent_dashboard()
    {
        return view('parent.dashboard');
    }
}
