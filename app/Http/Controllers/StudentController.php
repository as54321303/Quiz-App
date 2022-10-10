<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function student_dashboard()
    {
        return view('student.dashboard');
    }
    
    public function quiz_schedule()
    {
        return view('student.quiz.quiz_schedule');
    }

    public function quiz_grades()
    {
        return view('student.quiz.quiz_grades');
    }
    public function notice()
    {
        return view('student.notice.notice');
    }

}
