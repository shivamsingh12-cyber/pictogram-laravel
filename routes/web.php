<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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
});
Route::group(['middleware'=>'auth'],function(){
    Route::any('/home', [Controller::class,'dashboard']);
    Route::any('/logout', [Controller::class,'logout']);
});