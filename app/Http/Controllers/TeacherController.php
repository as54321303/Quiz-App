<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function teacher_dashboard()
    {
        return view('teacher.dashboard');
    }

    public function all_students()
    {

        return view('teacher.students.all_students');   
        
    }

    public function student_details()
    {

        return view('teacher.students.student_details'); 

    }

    public function quiz_schedule()
    {

        return view('teacher.quiz.quiz_schedule'); 

    }

    public function quiz_grades()
    {

        return view('teacher.quiz.quiz_grades'); 

    }

    public function groups()
    {
        return view('teacher.groups.index');
    }
}
