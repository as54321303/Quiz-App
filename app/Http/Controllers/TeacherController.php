<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
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


    public function group_detail()
    {
        return view('teacher.groups.group_detail');
    }


    public function assign_points()
    {
        return view('teacher.groups.assign_points');
    }

    public function post_assign_points()
    {
        session()->put('status','Points Assigned Successfully');
        return redirect('teacher/groups');
    }
}
