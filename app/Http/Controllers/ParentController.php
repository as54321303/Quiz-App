<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Hash;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\ParentKids;
use App\Models\Student;
use App\Models\Parents;


class ParentController extends Controller
{


    public function login()
    {
        if(session()->has('parentId')){
            return redirect()->route('parent.dashboard');
        }

        return view('parent.login');
    }

    public function login_post(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' =>'required|email|exists:parents',
            'password' =>'required'
        ], [
            'required' =>':attribute is required',
            'email.exists' =>':attribute does not exist',
        ]);
        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $checkEmail = DB::table('parents')->where(['email'=>$request->email])->first();

        if( !$checkEmail || !Hash::check($request->password , $checkEmail->password)) {
            return back()->with('err_msg', 'Invalid Email or Password');
        } else {
            session()->put('parentId', $checkEmail->id);
            return redirect()->route('parent.dashboard');
        }


    }

    public function signup()
    {
        if(session()->has('parentId')){
            return redirect()->route('parent.dashboard');
        }

        return view('parent.signup');
    }

    public function signup_post(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email|unique:parents",
            "contact" => "required|digits:10",
            "password" => "min:8|required_with:password_confirmation",
            "password_confirmation" => "min:8|same:password"
        ]);

        // return $validator;
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
            // return $validator;
        }

        try {
            
            DB::table('parents')->insert([
                      'name'=>$request->name,
                      'email'=>$request->email,
                    //   'contact'=>$request->contact,
                      'password'=>Hash::make($request->password),
                      'created_at'=>Carbon::now()->toDateTimeString(),
            ]);

            session()->put('message','Registration Successfull');
            return redirect()->route('parent.login');

          } catch (\Exception $e) {

            //   return $e->getMessage();
              return redirect()->route('parent.signup')->with('errors',$e->getMessage());

          }

    }



    public function parent_dashboard()
    {

        $parentId = session()->get('parentId');
        // return $parentId;
        $kids = ParentKids::where('parent_id','=',$parentId)
                ->join('students', 'students.id','=','parentkids.student_id')
                ->get(['students.id', 'name','userId','password','gender','dateOfBirth','class','bio','profilePic']);    
        // return $kids;
        return view('parent.dashboard',['kids'=>$kids]);
    }

    public function parent_addkid(Request $request)
    {
        /**
         * if user changes query parameters in URL
         */
        if(session()->get('parentId') != $request->get('parentId') || !$request->parentId)  {
            return back()->with('err_msg', 'Invalid Request');
        }

        return view('parent.kid.add', ['parentId' => $request->parentId]);
    }

    public function parent_addkidPost(Request $request)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            "fullName" => "required",
            "userId"=>"required|unique:students",
            "password"=>"required|min:8",
            "gender" => "required",
            "dob" => "required",
            "class" => "required",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        if($request->file('profilePic')){
	  
            $imageName = $request->profilePic->getClientOriginalName();

            $request->profilePic->move(public_path('uploads/Students'),$imageName);

            $profilePic = url('public/uploads/Students').'/'.$imageName;

            }
            else{
                $profilePic=null;
            }
           



        try {
            
            $insert =  DB::table('students')->insertGetId([
                      'name'=>$request->fullName,
                      'email'=>$request->email,
                      'user_id'=>$request->userId,
                      'password'=>Hash::make($request->password),
                      'gender'=>$request->gender,
                      'dateOfBirth' => $request->dob,
                      'class' => $request->class,
                      'bio' => $request->bio,
                      'profilePic'=>$profilePic
            ]);
            
            $ii =  DB::table('parentkids')->insert([
                "parent_id" => $request->parentId,
                "student_id" => $insert
            ]);


            session()->put('err_msg','You have added your child to the application');
            return redirect()->route('parent.dashboard');

          } catch (\Exception $e) {

              return $e->getMessage();
              return redirect()->route('parent.dashboard')->with('errors',$e->getMessage());

          }
        
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

    public function my_profile()
    {
        $parent_id=session('parentId');
        $details=DB::table('parents')->where('id',$parent_id)->first();
        return view('parent.my_profile',compact('details'));
    }


    public function update_profile(Request $request)
    {
        // return $request->all();
        $parent_id=session('parentId');


        
        if($request->file('profile_pic')){
	  
            $imageName = time().'.'.$request->profile_pic->extension();

            $request->profile_pic->move(public_path('uploads/profile_photos'),$imageName);

            $profile_pic=url('public/uploads/profile_photos').'/'.$imageName;

            }
            else{
                $profile_pic=null;
            }

        DB::table('parents')->where('id',$parent_id)->update([

            'name'=>$request->name,
            'email'=>$request->email,
            'contact'=>$request->contact,
            'gender'=>$request->gender,
            'profile_pic'=>$profile_pic,
            'dob'=>$request->dob,
            'religion'=>$request->religion,
            'occupation'=>$request->occupation,
            'address'=>$request->address,


        ]);

        session()->put('status','Profile Updated Successfully');
        return redirect()->route('parent.profile');
    }

    public function logout()
    {
        session()->forget('parentId');
        return redirect()->route('parent.login');
    }


}
