<?php

use App\User;
use Illuminate\Support\Facades\Schema;
use App\Player;
use App\Streamer;
// use \DB;
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


// Route::post('/checkurl', 'HomeController@checkurl');
Route::get('/test', function () {
  return view('test');
});

Route::get('/tl/{view}', function ($view) {
  return File::get(resource_path("templates/$view.ejs"));
});

Route::get('/', 'HomeController@frontpage');


Route::get('/twitch/{username}', 'PlayerController@twitch');
Route::get('/faq', 'FaqController@publicview');

Route::get('/sponsors', 'SponsorController@publicview');
Route::get('/news', 'NewsController@publicview');
Route::get('/news/{slug}', 'NewsController@articleview');

Route::post('/i/createuser', 'InviteController@createuser');
Route::get('/i/{invite}', 'InviteController@join');
Route::get('/p/{player}', 'PlayerController@profile');
Route::get('/p/youtube/{player}', 'PlayerController@getYoutube');

Route::group(['prefix' => 'roster'], function () {
  Route::get('/', 'RosterController@index');
  Route::get('/{parent}/{child?}', 'RosterController@parentChild');
  // Route::get('all', 'RosterController@all');
  // Route::get('creators', 'RosterController@creators');
  // Route::get('streamers', 'RosterController@streamers');
  // Route::get('team/{team}', 'RosterController@teams');
});

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
  Route::get('/', 'DashboardController@home')->middleware('verified');
  Route::group(['prefix' => 'overview', 'middleware' => ['permission:see site overview', 'verified']], function () {
    Route::get('{path?}', 'DashboardController@overview')->where('path', 'index');
  });
  Route::group(['prefix' => 'account'], function () {
    Route::get('{path?}', 'AccountController@index')->where('path', 'index')->name('account');
    Route::post('/name', 'AccountController@name');
    Route::post('/email', 'AccountController@email');
    Route::post('/password', 'AccountController@password');
  });
  Route::group(['prefix' => 'roles', 'middleware' => ['role:admin', 'verified']], function () {
    Route::get('{path?}', 'RoleController@index')->where('path', 'index');
    Route::post('/create', 'RoleController@create');
    Route::post('/delete', 'RoleController@delete');
  });
  Route::group(['prefix' => 'users', 'middleware' => ['permission:create users', 'verified']], function () {
    Route::get('{path?}', 'UserController@index')->where('path', 'index');
    Route::post('/create', 'UserController@create');
    Route::post('/delete', 'UserController@delete');
  });
  Route::group(['prefix' => 'categories', 'middleware' => ['permission:edit categories', 'verified']], function () {
    Route::get('{path?}', 'CategoryController@index')->where('path', 'index');
    Route::post('/create', 'CategoryController@create');
    Route::post('/delete', 'CategoryController@delete');
  });
  Route::group(['prefix' => 'players', 'middleware' => ['permission:edit players', 'verified']], function () {
    Route::get('{path?}', 'PlayerController@index')->where('path', 'index');
    Route::post('/create', 'PlayerController@create');
    Route::post('/delete', 'PlayerController@delete');
  });
  Route::group(['prefix' => 'settings', 'middleware' => ['permission:manage site settings', 'verified']], function () {
    Route::get('{path?}', 'SettingController@index')->where('path', 'index');
    Route::get('/getlinks', 'SettingController@getLinksJSON');
    Route::post('/navigation', 'SettingController@saveNavigation');
  });
  Route::group(['prefix' => 'faq', 'middleware' => ['permission:edit faq', 'verified']], function () {
    Route::get('{path?}', 'FaqController@index')->where('path', 'index');
    Route::post('/create', 'FaqController@create');
    Route::post('/delete', 'FaqController@delete');
  });
  Route::group(['prefix' => 'sponsors', 'middleware' => ['permission:edit sponsors', 'verified']], function () {
    Route::get('{path?}', 'SponsorController@index')->where('path', 'index');
    Route::post('/create', 'SponsorController@create');
    Route::post('/delete', 'SponsorController@delete');
  });
  Route::group(['prefix' => 'news', 'middleware' => ['permission:edit news', 'verified']], function () {
    Route::get('{path?}', 'NewsController@index')->where('path', 'index');
    Route::post('/create', 'NewsController@create');
    Route::post('/delete', 'NewsController@delete');
  });


  // Route::group(['prefix' => 'team', 'middleware' => ['auth.mod']], function () {
  //   Route::get('view', 'TeamController@view');
  //   Route::get('fetch', 'TeamController@fetch');
  //   Route::get('edit/{team}', 'TeamController@edit');
  //   Route::get('players/{team}', 'TeamController@players');
  //   Route::get('players/fetch/{team}', 'TeamController@players_fetch');
  //   Route::post('logo', 'TeamController@logo');
  //   Route::post('create', 'TeamController@create')->middleware('auth.admin');
  //   Route::post('update', 'TeamController@update');
  //   Route::post('delete', 'TeamController@delete')->middleware('auth.admin');
  //   Route::post('makemod', 'TeamController@makemod');
  // });
  // Route::group(['prefix' => 'invite', 'middleware' => ['auth.mod']], function () {
  //   Route::get('view', 'InviteController@view');
  //   Route::get('fetch', 'InviteController@fetch');
  //   Route::post('create', 'InviteController@create');
  //   // Route::post('delete', 'InviteController@delete');
  // });
  // Route::group(['prefix' => 'faq', 'middleware' => ['auth.admin']], function () {
  //   Route::get('view', 'FaqController@view');
  //   Route::get('fetch', 'FaqController@fetch');
  //   Route::get('edit/{faq}', 'FaqController@edit');
  //   Route::post('update', 'FaqController@update');
  //   Route::post('create', 'FaqController@create');
  //   Route::post('delete', 'FaqController@delete');
  // });
  // Route::group(['prefix' => 'sponsor', 'middleware' => ['auth.admin']], function () {
  //   Route::get('view', 'SponsorController@view');
  //   Route::get('fetch', 'SponsorController@fetch');
  //   Route::get('edit/{sponsor}', 'SponsorController@edit');
  //   Route::post('update', 'SponsorController@update');
  //   Route::post('create', 'SponsorController@create');
  //   Route::post('delete', 'SponsorController@delete');
  //   Route::post('image', 'SponsorController@image');
  // });
});









//AUTH ROUTES

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::any('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
if (Schema::hasTable('users') || env('ALLOW_REGISTRATION')) {
  if(User::count() <= 0 || env('ALLOW_REGISTRATION')) {
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
  }
}



// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email Verification Routes...
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

// Route::get('/home', 'HomeController@index')->name('home');
