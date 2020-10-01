<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\Authenticate;

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

Auth::routes();
Route::get('/recover', 'Auth\RecoverController@recover')->name('recover');
Route::post('/recover', 'Auth\RecoverController@recover_account')->name('recover_account');
// Middle Login for Admin 
Route::post('/middlelogin', 'Auth\LoginController@middle_login')->name('middle_login');
Route::get('/middlelogin', 'Auth\LoginController@middle_login_get')->name('middle_login_get');

// Next Step for Register 
Route::post('/register/next', 'Auth\RegisterController@register_next')->name('register_next');
Route::get('/register/next', 'Auth\RegisterController@show_register_next')->name('show_register_next');

Route::get('/developer', 'DashboardController@developer')->name('developer');
Route::get('/', 'DashboardController@index')->name('index');
Route::get('/feedback', 'DashboardController@feedback')->name('feedback');

//Practice
Route::get('/practice/topicwise' ,'PracticeController@topicwise_index' )->name('practice.topicwise.index');
Route::get('/practice/topicwise/{id}' ,'PracticeController@topicwise_show' )->name('practice.topicwise.show');

Route::get('/practice/general' ,'PracticeController@general_index' )->name('practice.general.index');
Route::get('/practice/general/{id}' ,'PracticeController@general_show' )->name('practice.general.show');

//Dashboard Route Start
//Login Required 
Route::middleware([Authenticate::class])->group(function () {

    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');

    Route::get('/edit', 'UserController@edit')->name('user.edit');
    Route::post('/', 'UserController@update')->name('user.update');

    //Ladders
    Route::get('/ladders/topicwise' ,'LadderController@topicwise_index' )->name('ladders.topicwise.index');
    Route::get('/ladders/topicwise/{id}' ,'LadderController@topicwise_show' )->name('ladders.topicwise.show');

    Route::get('/ladders/general' ,'LadderController@general_index' )->name('ladders.general.index');
    Route::get('/ladders/general/{id}' ,'LadderController@general_show' )->name('ladders.general.show');

    Route::get('/upsolve' , 'UpsolveController@index')->name('upsolve.index');
    Route::get('/upsolve/virtual' , 'UpsolveController@virtual')->name('upsolve.virtual');
    Route::get('/upsolve/wrong' , 'UpsolveController@wrong')->name('upsolve.wrong');


});


// Admin Routes Start 
Route::middleware([CheckAdmin::class])->group(function () {

    Route::get('/feedback/response', 'DashboardController@feedback_response')->name('feedback_response');

    Route::group(['prefix' => 'problems'], function () {
                Route::get('/', 'ProblemController@index')->name('problem.index');
                Route::get('/create','ProblemController@create')->name('problem.create');
                Route::post('/', 'ProblemController@store')->name('problem.store');
                Route::get('/{id}/edit', 'ProblemController@edit')->name('problem.edit');
                Route::put('/{id}', 'ProblemController@update')->name('problem.update');
                Route::delete('/{id}', 'ProblemController@destroy')->name('problem.destroy');
                Route::get('/suggested', 'ProblemController@suggested')->name('problem.suggested');

            });

    Route::group(['prefix' => 'topics'], function () {
                Route::get('/', 'TopicController@index')->name('topic.index');
                Route::get('/create','TopicController@create')->name('topic.create');
                Route::post('/', 'TopicController@store')->name('topic.store');
                Route::get('/{id}/edit', 'TopicController@edit')->name('topic.edit');
                Route::put('/{id}', 'TopicController@update')->name('topic.update');
                Route::delete('/{id}', 'TopicController@destroy')->name('topic.destroy');
                Route::get('/suggested', 'TopicController@suggested')->name('topic.suggested');

            });

    Route::group(['prefix' => 'generaltopics'], function () {
                Route::get('/', 'GeneraltopicController@index')->name('Generaltopic.index');
                Route::get('/create','GeneraltopicController@create')->name('Generaltopic.create');
                Route::post('/', 'GeneraltopicController@store')->name('Generaltopic.store');
                Route::get('/{id}/edit', 'GeneraltopicController@edit')->name('Generaltopic.edit');
                Route::put('/{id}', 'GeneraltopicController@update')->name('Generaltopic.update');
                Route::delete('/{id}', 'GeneraltopicController@destroy')->name('Generaltopic.destroy');

            });

    Route::group(['prefix' => 'users'], function () {
                Route::get('/', 'UserController@index')->name('users.index');
                Route::post('/{id}', 'UserController@update_role')->name('user.update_role');
            });

});