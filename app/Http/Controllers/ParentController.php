<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Hash;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
                      'contact'=>$request->contact,
                      'password'=>Hash::make($request->password),
                      'created_at'=>Carbon::now()->toDateTimeString(),
            ]);

            session()->put('message','Registration Successfull');
            return redirect()->route('parent.login');

          } catch (\Exception $e) {

              //return $e->getMessage();
              return redirect()->route('parent.signup')->with('errors',$e->getMessage());

          }




    }



    public function parent_dashboard()
    {

        return view('parent.dashboard');
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
}
