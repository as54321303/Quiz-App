<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function parent_dashboard()
    {
        return view('parent.dashboard');
    }

    public function assign_points()
    {
        return view('parent.assign_points');
    }

    public function post_assign_points()
    {
        session()->put('status','Points Assigned Successfully');
        return redirect('parent/dashboard');
    }
}
