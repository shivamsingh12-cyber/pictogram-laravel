<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\ChattingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\serachController;
use App\Http\Middleware\UserStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;


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

// Route::any('/signup', function () {
//     return view('signup',['page_title'=>'Signup']);
// });


Route::group(['middleware'=>'guest'],function(){
    Route::any('/signup',[Controller::class,'signup'])->name('register');
    Route::any('/login',[Controller::class,'login'])->name('login');
    Route::any('/checkemail',[Controller::class,'checkemail'])->name('checkemail');
    Route::any('/resetpass',[Controller::class,'resetpass']);
    Route::any('/admin',[adminController::class,'adminlogin']);
    Route::any('/',[Controller::class,'login'])->name('login');
    Route::any('/adminhome',[adminController::class,'table'])->name('table');
    Route::any('/block/{id}',[adminController::class,'blockuser']);
    // Route::any('/loginuser/{id}', [adminController::class,'userpage']);
});

Route::group(['middleware'=>'auth','admin'],function(){
    // Route::get('/loginuser/{id}', [adminController::class, 'userpage']);
    Route::get('/loginuser/{id}', [adminController::class, 'admindashboard']);
    Route::any('/block',[Controller::class,'block'])->name('block');
    Route::get('/searchuser/{search}',[serachController::class,'search']);
    Route::any('/verify',[Controller::class,'verify'])->name('verify');
    Route::any('/home', [Controller::class,'dashboard']);
    Route::any('/editprofile',[Controller::class,'editprofile'])->name('edit_profile')->middleware(UserStatus::class);
    Route::any('/add_posts',[Controller::class,'addposts'])->name('add_posts')->middleware(UserStatus::class);
    // Route::any('/home?editprofile', [Controller::class,'dashboard']);
    Route::get('/mainprofile/{name?}',[Controller::class,'mainprofile'])->name('main_profile')->middleware(UserStatus::class);
    Route::post('/follow/{user_id}',[Controller::class,'follow']);
    Route::any('/unfollow/{user_id}',[Controller::class,'unfollow']);
    Route::any('/post/{post_name}',[Controller::class,'likepost']);
    Route::any('/unpost/{post_name}',[Controller::class,'unlikepost']);
    Route::any('/notify',[NotificationController::class,'shownotification']);
    Route::post('/closenotify',[NotificationController::class,'closenotification']);
    Route::any('/addcomment/{comment}/pid/{pid}',[Controller::class,'addcomment']);
    Route::any('/checkmessage',[ChattingController::class,'getchats']);
    Route::any('/sendmessage',[ChattingController::class,'sendMessage']);
    // Route::any('/checkmessage2/{id}',[ChattingController::class,'getMessages']);
    Route::any('/logout', [Controller::class,'logout']);
});