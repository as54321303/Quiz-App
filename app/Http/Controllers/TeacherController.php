<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Teacher;
use App\Models\TeacherClass;
use App\Models\Groups;
use App\Models\Student;
use Hash;
use Validator;
use DB;

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
        $teacherId = session('teacherId');
        if($request->has('class')){
            
            $class = TeacherClass::where('teacherId',$teacherId)
            ->join('students', 'students.class','=','teacher_classes.class')
            ->where('teacher_classes.class','=', $request->class)
            ->get();

        
     

            return view('teacher.students.all_students',compact('class'));   
        
        } else {
                // $teacherId = session('teacherId');

                $class = TeacherClass::where('teacherId',$teacherId)
                ->join('students', 'students.class','=','teacher_classes.class')
                ->get();


                return view('teacher.students.all_students',compact('class')); 
        }

        
        
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
        $teacherId = session()->get('teacherId');
        $data = Groups::where('createdByTeacherId', $teacherId)->get();
        // return $data;
        $data->totalMembers = '';
        $data->totalPoints = '';
        $data->class = '';

        $class = TeacherClass::where('teacherId', $teacherId)->get();
        return view('teacher.groups.index', ['data'=>$data, 'class'=>$class]);
    }

    public function createGroup(Request $request)
    {
        // return $request;
        $teacherId = session()->get('teacherId');
        $insert = new Groups;
        $insert->createdByTeacherId = $teacherId;
        $insert->groupName = $request->group_name;
        $insert->class = $request->class;
        $insert->save();

        $groupId = $insert->id;
        for($i = 0; $i< count($request->students); $i++){
            DB::table('student_group')->insert([
                "groupId" => $groupId,
                "studentId" => $request->students[$i]
            ]);
        }
        session()->put('err_msg', 'Group Added Successfully');
        return redirect()->route('teacher.listGroups');

        
    }

    /**
     * for fetching students in class ajax call
     */
    public function getStudentList($class)
    {
        $data = Student::where('class', $class)->get();
        $option = '';
        foreach($data as $rows){
            $option .= "<option value='$rows->id'>$rows->name</option>";
        }
        return $option;
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
