<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ParentController;
// use App\Http\Middleware\CheckAdminLogin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Starter Route

Route::get('/',function(){
          return view('main');
});



// Admin Routes

    Route::prefix('admin')->group(function () {
        Route::get('login', [AdminController::class,'login'])->name('adminLogin');
        Route::post('login_post', [AdminController::class,'login_post'])->name('adminLoginPost');

        Route::get('signup', [AdminController::class,'signup'])->name('adminSignup');
        Route::post('signup-post', [AdminController::class,'signup_post'])->name('adminSignupPost');
        
        Route::get('dashboard', [AdminController::class,'admin_dashboard'])->name('adminDashboard')->middleware('CheckAdminLogin');
        Route::get('all-students',[AdminController::class,'all_students']);
        Route::get('student-details',[AdminController::class,'student_details']);
        Route::get('all-teachers',[AdminController::class,'all_teachers']);
        Route::get('teacher-details',[AdminController::class,'teacher_details']);
        Route::get('all-parents',[AdminController::class,'all_parents']);
        Route::get('parent-deatils',[AdminController::class,'parent_details']);
        Route::get('parent-deatils',[AdminController::class,'parent_details']);
        Route::get('groups',[AdminController::class,'groups']);
        Route::get('quiz-schedule',[AdminController::class,'quiz_schedule']);
        Route::get('quiz-grades',[AdminController::class,'quiz_grades']);
    });


// Teacher Routes
Route::prefix('teacher')->group(function () {

    Route::get('login', [TeacherController::class,'login'])->name('teacherLogin');
    Route::post('login-post', [TeacherController::class,'login_post'])->name('teacherLoginPost');

    Route::get('signup', [TeacherController::class,'signup'])->name('teacherSignup');
    Route::post('signup-post', [TeacherController::class,'signup_post'])->name('teacherSignupPost');

    Route::middleware(['CheckTeacherLogin'])->group(function(){

                    
                Route::get('dashboard',[TeacherController::class,'teacher_dashboard'])->name('teacher.dashboard');
                Route::get('all-students',[TeacherController::class,'all_students']);
                Route::get('student-details',[TeacherController::class,'student_details']);
                Route::get('groups',[TeacherController::class,'groups']);
                Route::get('group-detail',[TeacherController::class,'group_detail']);
                Route::get('quiz-schedule',[TeacherController::class,'quiz_schedule']);
                Route::get('quiz-grades',[TeacherController::class,'quiz_grades']);
                Route::get('assign-points',[TeacherController::class,'assign_points']);
                Route::post('post-assign-points',[TeacherController::class,'post_assign_points']);



    });





});



// Student Routes
Route::prefix('student')->group(function () {
    Route::get('dashboard',[StudentController::class,'student_dashboard']);
    Route::get('quiz-schedule',[StudentController::class,'quiz_schedule']);
    Route::get('quiz-grades',[StudentController::class,'quiz_grades']);
    Route::get('notice',[StudentController::class,'notice']);
});


// Parent Routes
Route::prefix('parent')->group(function () {

    Route::get('login',[ParentController::class,'login'])->name('parent.login');
    Route::post('login-post',[ParentController::class,'login_post'])->name('parent.login.post');

    Route::get('signup',[ParentController::class,'signup'])->name('parent.signup');
    Route::post('signup-post',[ParentController::class,'signup_post'])->name('parent.signup.post');


    Route::middleware(['CheckParentLogin'])->group(function(){

        
            Route::get('dashboard',[ParentController::class,'parent_dashboard'])->name('parent.dashboard');  
            Route::get('addkid',[ParentController::class,'parent_addkid'])->name('parent.addKid');
            Route::post('addkidPost',[ParentController::class,'parent_addkidPost'])->name('parent.kid.post');

            Route::get('assign-points',[ParentController::class,'assign_points']);
            Route::post('post-assign-points',[ParentController::class,'post_assign_points']); 
            Route::get('my-profile',[ParentController::class,'my_profile'])->name('parent.profile');
            Route::post('update-profile',[ParentController::class,'update_profile'])->name('parent.update.profile');
            Route::get('change-pic/{id}',[ParentController::class,'change_profile_pic'])->name('change.profile.pic');
            Route::get('logout',[ParentController::class,'logout'])->name('parent.logout');

    });


});

