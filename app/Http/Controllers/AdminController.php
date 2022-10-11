<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Models\Admin;
use Validator;

class AdminController extends Controller
{

    public function login()
    {
        return view('admin.login');
    }
    
    public function signup()
    {
        return view('admin.signup');
    }
    
    public function signup_post(Request $request)
    {
        // $validator = 
    }

    public function admin_dashboard()
    {
        return view('admin.dashboard');
    }

    public function all_students()
    {
        return view('admin.students.all_students');
    }

    public function student_details()
    {
        return view('admin.students.student_details');
    }

    public function all_teachers()
    {
        return view('admin.teachers.all_teachers');
    }

    public function teacher_details()
    {
        return view('admin.teachers.teacher_details');
    }

    public function all_parents()
    {
        return view('admin.parents.all_parents');
    }

    public function parent_details()
    {
        return view('admin.parents.parent_details');
    }

    public function quiz_schedule()
    {
        return view('admin.quiz.quiz_schedule');
    }

    public function quiz_grades()
    {
        return view('admin.quiz.quiz_grades');
    }

    public function groups()
    {
        return view('admin.groups.index');
    }
}
