<?php

use App\Http\Middleware\UserStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;

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
    Route::any('/',[Controller::class,'login'])->name('login');
});

Route::group(['middleware'=>'auth'],function(){
    Route::any('/block',[Controller::class,'block'])->name('block');
    // Route::get('/sendmail',[EmailController::class,'sendEmail'])->name('/sendmail');
    Route::any('/verify',[Controller::class,'verify'])->name('verify');
    Route::any('/home', [Controller::class,'dashboard'])->middleware(UserStatus::class);
    Route::any('/editprofile',[Controller::class,'editprofile'])->name('edit_profile')->middleware(UserStatus::class);
    Route::any('/add_posts',[Controller::class,'addposts'])->name('add_posts')->middleware(UserStatus::class);
    // Route::any('/home?editprofile', [Controller::class,'dashboard']);
    Route::get('/mainprofile/{name?}',[Controller::class,'mainprofile'])->name('main_profile')->middleware(UserStatus::class);
    Route::post('/follow/{user_id}',[Controller::class,'follow']);
    Route::any('/unfollow/{user_id}',[Controller::class,'unfollow']);
    Route::any('/logout', [Controller::class,'logout']);
});