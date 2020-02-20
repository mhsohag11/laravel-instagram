<?php

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

Route::get('/home', function () {
    return view('welcome');
});

Auth::routes();

/**
 * /profile/1 => showing profile
 * /profile/1/edit => redirect editing page
 * /profile/1 => patch/put => when hit update button from edit page
 */
Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');

/**
 * / => showing home page => in there query all following user posts
 * /p/create => when someone click for adding new post from his own profile page => view create page
 * /p => when click add button for adding new post from post create page => post verb
 * /p/1 => showing single post => get
 */
Route::get('/', 'PostsController@index')->name('post.index');
Route::get('/p/create', 'PostsController@create');
Route::post('/p', 'PostsController@store')->name('post.store');
Route::get('/p/{post}', 'PostsController@show');

/**
 * When click follow button from profile page store this current profile under User>Following table name profile_user_pivot table
 */
Route::post('/follow/{user}', 'FollowsController@store');


Route::get('/mail', function (){
    return new \App\Mail\NewUserWelcomeMail();
});