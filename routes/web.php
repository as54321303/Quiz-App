<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ParentController;
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

Route::get('main',function(){
          return view('main');
});



// Admin Routes

Route::get('admin/dashboard',[AdminController::class,'admin_dashboard']);
Route::get('admin/all-students',[AdminController::class,'all_students']);
Route::get('admin/student-details',[AdminController::class,'student_details']);
Route::get('admin/all-teachers',[AdminController::class,'all_teachers']);
Route::get('admin/teacher-details',[AdminController::class,'teacher_details']);
Route::get('admin/all-parents',[AdminController::class,'all_parents']);
Route::get('admin/parent-deatils',[AdminController::class,'parent_details']);
Route::get('admin/parent-deatils',[AdminController::class,'parent_details']);
Route::get('admin/groups',[AdminController::class,'groups']);
Route::get('admin/quiz-schedule',[AdminController::class,'quiz_schedule']);
Route::get('admin/quiz-grades',[AdminController::class,'quiz_grades']);

// Teacher Routes

Route::get('teacher/dashboard',[TeacherController::class,'teacher_dashboard']);
Route::get('teacher/all-students',[TeacherController::class,'all_students']);
Route::get('teacher/student-details',[TeacherController::class,'student_details']);
Route::get('teacher/groups',[TeacherController::class,'groups']);
Route::get('teacher/quiz-schedule',[TeacherController::class,'quiz_schedule']);
Route::get('teacher/quiz-grades',[TeacherController::class,'quiz_grades']);

// Student Routes

Route::get('student/dashboard',[StudentController::class,'student_dashboard']);
Route::get('student/quiz-schedule',[StudentController::class,'quiz_schedule']);
Route::get('student/quiz-grades',[StudentController::class,'quiz_grades']);
Route::get('student/notice',[StudentController::class,'notice']);

// Parent Routes

Route::get('parent/dashboard',[ParentController::class,'parent_dashboard']);
