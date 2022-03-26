<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// User
Route::post('login', 'Api\AuthController@login');
Route::post('register', 'Api\AuthController@register');
Route::get('logout', 'Api\AuthController@logout');
Route::post('save_user_info', 'Api\AuthController@saveUserInfo')->middleware('jwtAuth');


// Post
Route::post('posts/create', 'Api\PostsController@create')->middleware('jwtAuth');
Route::post('posts/delete', 'Api\PostsController@delete')->middleware('jwtAuth');
Route::post('posts/update', 'Api\PostsController@update')->middleware('jwtAuth');
Route::get('posts', 'Api\PostsController@posts')->middleware('jwtAuth');

// Comment
Route::post('comments/create', 'Api\CommentsController@create')->middleware('jwtAuth');
Route::post('comments/delete', 'Api\CommentsController@delete')->middleware('jwtAuth');
Route::post('comments/update', 'Api\CommentsController@update')->middleware('jwtAuth');
Route::get('posts/comments', 'Api\CommentsController@comments')->middleware('jwtAuth');

// Like
Route::post('posts/like', 'Api\LikesController@like')->middleware('jwtAuth');


// Route::group([
//           'middleware' => 'api',
//           'namespace' => 'App\Http\Controllers\Api',
//           'prefix' => 'auth'
// ], function ($router){
          
          

// });



// Route::post('login','StudentController@login');

// Route::get('redirects', [HomeController::class, 'index']);
// Route::resource('courses/list', CoursesController::class);
// Route::resource('attendances/att_list', AttendanceController::class);
// Route::get('attendances/att_spec_list/{id}', "CoursesController@show");
// Route::get('/export', [App\http\Controllers\AttendanceController::class, 'export']);
