<?php
use App\Events\eventTrigger;
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
Route::get('/register-step2','RegisterStep2Controller@showForm')->name('register.step2');
Route::post('/register-step2','RegisterStep2Controller@postForm')->name('register.step2');
Route::resource('/posts','PostController');

//CSV Export Route
Route::get('zipfilelist', 'Admin\UsersController@index')->name('zipfilelist');
Route::get('choose-date', 'Admin\UsersController@choose_date')->name('choosedate');
Route::post('choose-date', 'Admin\UsersController@post_choose_date')->name('postdate');
Route::get('choose-kindergarten', 'Admin\UsersController@chooseKindergarten')->name('choosekindergarten');
Route::get('download/{filename}', 'Admin\UsersController@downloadZip')->name('downloadzip');
Route::get('removefile/{id}/{filename}', 'Admin\UsersController@removeFile')->name('removefile');
Route::post('users/export/', 'Admin\UsersController@export')->name('export');
Route::post('/fileAttachementsZip','Admin\UsersController@zipAttachment')->name('zipcreate');
//end csv e

Route::post('/getmsg','AjaxController@index');
 

// Route::get('/','Admin\UsersController@index');

Route::get('user/activation/{token}','Auth\RegisterController@userActivation');
Route::get('user/activation/{token}','Auth\RegisterController@userActivation');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth','isAdmin')->namespace('admin')->group(function(){
    Route::get('admin/users','UsersController@index')->name('admin.users');
    Route::get('admin/prospects','ProspectsController@index')->name('admin.prospects');
    Route::post('admin/prospects/store','ProspectsController@store')->name('admin.prospects.store');
    Route::get('admin/user/{id}','UsersController@getUser')->name('admin.getuser');
    Route::put('admin/user/{id}/update','UsersController@updateUser')->name('admin.users.update');
    Route::post('admin/users/store','UsersController@store')->name('admin.users.store');
});




