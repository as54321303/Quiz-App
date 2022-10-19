<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Models\Admin;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Validator;
use session;

class AdminController extends Controller
{

    public function login()
    {
        if(session()->has('adminId')) {
            return redirect()->route('adminDashboard');
        }
        return view('admin.login');
    }
    
    public function login_post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' =>'required|email|exists:admins',
            'password' =>'required'
        ], [
            'required' =>':attribute is required',
            'email.exists' =>':attribute does not exist',
        ]);
        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $checkEmail = Admin::where(['email'=>$request->email])->first();

        if( !$checkEmail || !Hash::check($request->password , $checkEmail->password)) {
            return back()->with('err_msg', 'Invalid Email or Password');
        } else {
            session()->put('adminId', $checkEmail->id);
            return redirect()->route('adminDashboard');
        }

    }
    
    public function signup()
    {
        return view('admin.signup');
    }
    
    public function signup_post(Request $request)
    {
        // return $request;    
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email|unique:admins",
            "password" => "min:8|required_with:password_confirmation",
            "password_confirmation" => "min:8|same:password"
        ]);

        // return $validator;
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
            // return $validator;
        }

        try {
            $insert = new Admin;
            $insert->name = $request->name;
            $insert->email = $request->email;
            $insert->password = Hash::make($request->password);
            $insert->save();

            return redirect()->route('adminLogin')->with('message','Admin Created Successfully');

          } catch (\Exception $e) {

              //return $e->getMessage();
              return redirect()->route('adminSignupPost')->with('errors',$e->getMessage());

          }
        


    }


    public function logout()
    {
        session()->forget('adminId');

        return redirect()->route('adminLogin');
    }

    public function admin_dashboard()
    {
        return view('admin.dashboard');
    }

    public function all_students()
    {
        $students=Student::join('parentKids','students.id','=','parentKids.student_id')
        ->join('parents','parents.id','=','parentKids.parent_id')->get(['students.name as sName',
       'students.gender','students.class','students.dateOfBirth','parents.name as pName','parents.address','parents.contact']);
        // return $students;

        return view('admin.students.all_students',compact('students'));
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
        $parents=DB::table('parents')->get();
        // return $parents;
        return view('admin.parents.all_parents',compact('parents'));
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
