<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Hash;
use DB;

class StudentController extends Controller
{
    public function login()
    {
        if(session()->has('studentId')){
            return redirect()->route('student.dashboard');
        }
        return view('student.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'userId'=>'required',
            'password'=>'required'
        ]);
        

            $student=Student::where('userId','=',$request->userId)->first();

            if($student){

                if(Hash::check($request->password, $student->password)){

                    session()->put('studentId',$student->id);

                    return redirect()->route('student.dashboard');

                }

                else{

                    return back()->withErrors('Incorrect Password!');

                }

            }

            return back()->withErrors('User Id not found!');

    }


    public function logout()
    {
        session()->forget('studentId');
        return redirect()->route('student.login');
    }

    public function studentDashboard()
    {
        $studentId=session('studentId');
        $details=Student::where('students.id',$studentId)->join('parentkids','students.id','=','parentkids.student_id')
        ->join('parents','parents.id','=','parentkids.parent_id')->first(['students.name as sName',
        'students.gender','students.class','students.dateOfBirth','parents.name as pName','students.id',
        'students.profilePic','parents.email as pEmail','students.userId','students.bio']);
// return $details;
        return view('student.dashboard',compact('details'));
    }


    public function myGroup()
    {
        $studentId=session('studentId');
        $group=DB::table('student_group')->where('studentId',$studentId)->first();
        $groupDetails=DB::table('student_group')->where('groupId','=',$group->groupId)->join('groups','student_group.groupId','=','groups.id')
        ->join('students','student_group.studentId','=','students.id')->get();
        // return $groupDetails;
        $totalPoints=DB::table('teacher_assign_points')->where('groupId','=',$group->groupId)->sum('point');
   

        return view('student.group.index',compact('groupDetails','totalPoints'));
    }


    public function feedback()
    {
        $studentId=session('studentId');
        $teacherFeedback=DB::table('teacher_feedbacks')->where('studentId',$studentId)->join('teachers','teacher_feedbacks.teacherId','=','teachers.id')
        ->orderBy('teacher_feedbacks.id','desc')->get(['teacher_feedbacks.title','teacher_feedbacks.description','teacher_feedbacks.created_at','teachers.name']);
        // ->join('parentkids','teacher_feedbacks.studentId','=','parentkids.student_id')
        // ->join('parents','parentkids.parent_id','=','parents.id')->get();
        return view('student.feedback.index',compact('teacherFeedback'));

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
