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

    public function student_details($id)
    {

        $details=Student::where('students.id',$id)->join('parentkids','students.id','=','parentkids.student_id')
        ->join('parents','parents.id','=','parentkids.parent_id')->first(['students.name as sName','students.profilePic',
        'students.gender','students.class','students.dateOfBirth','parents.name as pName','parents.email']);
//   return $details;
        return view('teacher.students.student_details',compact('details')); 

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
        $data = Groups::where('createdByTeacherId', $teacherId)->orderBy('id','desc')->get();

        $class = TeacherClass::where('teacherId', $teacherId)->get();
        return view('teacher.groups.index', ['data'=>$data, 'class'=>$class]);
    }

    public function createGroup(Request $request)
    {
        // return $request;
        $totalMember=count($request->students);
        $teacherId = session()->get('teacherId');
        $insert = new Groups;
        $insert->createdByTeacherId = $teacherId;
        $insert->groupName = $request->group_name;
        $insert->class = $request->class;
        $insert->totalMember = $totalMember;
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

        $notAssignedStudents=array();
        $students=Student::where('class',$class)->get();

        foreach($students as $check){

           $check2= DB::table('student_group')->where('studentId',$check->id)->get()->count();

            if(!$check2)
            {

                    $studentData= Student::where('class','=',$class)->where('id',$check->id)->first();

                    array_push($notAssignedStudents,$studentData);

            }

        }


        $option = '';
        foreach($notAssignedStudents as $rows){
            $option .= "<option value='$rows->id'>$rows->name</option>";
        }
        return $option;
    }


    public function group_detail($groupId)
    {
        $students=DB::table('student_group')->where('student_group.groupId',$groupId)->join('students','student_group.studentId','=','students.id')->get();
    //    return $students;
        return view('teacher.groups.group_detail',['students'=>$students]);
    }


    public function remove_group_member($sId)
    {

        DB::table('student_group')->where('studentId',$sId)->delete();
        return back()->with('status','Group Member Deleted');
    }

    public function add_group_member(Request $request)
    {
        $groupId= $request->groupId;


        for($i = 0; $i< count($request->students); $i++){
            DB::table('student_group')->insert([
                "groupId" => $groupId,
                "studentId" => $request->students[$i]
            ]);
        }

        return redirect()->back()->with('status','Member Added Successfully!');


    }


    public function studentFeedback(Request $request)
    {


        $teacherId=session('teacherId');
        DB::table('teacher_feedbacks')->insert([
            'teacherId'=>$teacherId,
            'studentId'=>$request->studentId,
            'title'=>$request->title,
            'description'=>$request->description,
        ]);

        return redirect()->back()->with('status','Feedback sent successfully!');

    }


    public function showPoint($groupId)
    {

        $teacherId=session('teacherId');
        $totals=0;
        $details=DB::table('teacher_assign_points')->where('teacherId','=',$teacherId)->where('groupId','=',$groupId)->get();
    
        foreach($details as $item)
        {
            $totals=$totals+$item->point;
        }
 
        return view('teacher.groups.show_points',compact('totals','details'));
   
    }

    public function assign_points($groupId)
    {

        $group=DB::table('groups')->where('id',$groupId)->first();

        return view('teacher.groups.assign_points',compact('group'));
    }

    public function post_assign_points(Request $request)
    {
            $teacherId=session('teacherId');
                $array = [
            ['groupId' => $request->groupId ,'teacherId' => $teacherId ,'reason'=>'Punctual' , 'point'=> $request->punctual],
            ['groupId' => $request->groupId ,'teacherId' => $teacherId ,'reason'=>'Discipline', 'point' => $request->discipline],
            ['groupId' => $request->groupId ,'teacherId' => $teacherId ,'reason'=>'Respectful', 'point' => $request->respectful],
            ['groupId' => $request->groupId ,'teacherId' => $teacherId ,'reason'=>'Contributing', 'point' => $request->contributing],
            ['groupId' => $request->groupId ,'teacherId' => $teacherId ,'reason'=>'Organized', 'point' => $request->organized],
            ['groupId' => $request->groupId ,'teacherId' => $teacherId ,'reason'=>'Performing' , 'point'=> $request->performing],
            ['groupId' => $request->groupId ,'teacherId' => $teacherId ,'reason'=>'Responsible', 'point' => $request->responsible],
            ['groupId' => $request->groupId ,'teacherId' => $teacherId ,'reason'=>'Co-operative' , 'point'=> $request->coperative],
            ['groupId' => $request->groupId ,'teacherId' => $teacherId ,'reason'=>'Leadership' , 'point'=> $request->leadership],
            ['groupId' => $request->groupId ,'teacherId' => $teacherId ,'reason'=>'Determined' , 'point'=> $request->determined],
            ['groupId' => $request->groupId ,'teacherId' => $teacherId ,'reason'=>'Self-Confidence' , 'point'=> $request->selfConfidence],
            ['groupId' => $request->groupId ,'teacherId' => $teacherId ,'reason'=>'Obedient' , 'point'=> $request->obedient],
       ];
       
       $insert = DB::table('teacher_assign_points')->insert($array);

       if($insert)
       {
            session()->put('err_msg','Points Assigned Successfully');
            return redirect()->route('teacher.listGroups');
       } else {
            session()->put('err_msg','Some error occured');
            return redirect()->back()->withInput();
       }

    }
}
