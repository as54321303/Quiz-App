<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Teacher;
use App\Models\TeacherClass;
use Hash;
use Validator;

class TeacherController extends Controller
{

    public function login()
    {

        if(session()->has('teacherId')){
            return redirect()->route('teacher.dashboard');
        }
        return view('teacher.login');
    }



        public function login_post(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'email' =>'required|email|exists:teachers',
                'password' =>'required'
            ], [
                'required' =>':attribute is required',
                'email.exists' =>':attribute does not exist',
            ]);
            if($validator->fails())
            {
                return back()->withErrors($validator)->withInput();
            }
    
            $checkEmail = Teacher::where(['email'=>$request->email])->first();
    
            if( !$checkEmail || !Hash::check($request->password , $checkEmail->password)) {
                return back()->with('err_msg', 'Invalid Email or Password');
            } else {
                session()->put('teacherId', $checkEmail->id);
                return redirect()->route('teacher.dashboard');
            }

    
        }


        public function logout()
        {
            
        session()->forget('teacherId');
        return redirect()->route('teacherLogin');

        }

        public function signup()
        {

            if(session()->has('teacherId')){
                return redirect()->route('teacher.dashboard');
            }
            return view('teacher.signup');
        }

        public function signup_post(Request $request)
        {

            // return $request->all();
            $validator = Validator::make($request->all(), [
                "name" => "required",
                "email" => "required|email|unique:teachers",
                "contact" => "required|digits:10",
                "class"=>"required",
                "dob"=>"required",
                "password" => "min:8|required_with:password_confirmation",
                "password_confirmation" => "min:8|same:password"
            ]);
    
            // return $validator;
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
                // return $validator;
            }
    
            // try {
                $insert = new Teacher();
                $insert->name = $request->name;
                $insert->email = $request->email;
                $insert->contact=$request->contact;
                $insert->dob=$request->dob;
                $insert->password = Hash::make($request->password);
                $insert->save();

                $teacherId= $insert->id;
            
              

                for($i=0;$i<count($request->class);$i++){

                   TeacherClass::insert([

                    'teacherId'=>$teacherId,
                    'class'=>$request->class[$i],

                   ]);

                }


                session()->put('message','Registration Successfull');
                return redirect()->route('teacherLogin');
    
            //  } 
            // catch (\Exception $e) {
    
            //     // return "true";
            //       //return $e->getMessage();
            //       return redirect()->route('teacherSignup')->with('errors',$e->getMessage());
    
            //   }




        }



    public function teacher_dashboard()
    {
 
        return view('teacher.dashboard');
    }

    public function all_students(Request $request)
    {

        $teacherId=session('teacherId');
        $details=Teacher::where('id',$teacherId)->first();
        $className=TeacherClass::where('teacherId',$teacherId)->get();
    


        $teacherId = session('teacherId');
        if($request->has('class')){
            
            $class = TeacherClass::where('teacherId',$teacherId)
            ->join('students', 'students.class','=','teacher_classes.class')
            ->where('teacher_classes.class','=', $request->class)
            ->get();

        
     
 
        
        } else {
                // $teacherId = session('teacherId');

                $class = TeacherClass::where('teacherId',$teacherId)
                ->join('students', 'students.class','=','teacher_classes.class')
                ->get();


        }

        return view('teacher.students.all_students',compact('class','className')); 
        
        
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
