<?php

use App\User;
use Illuminate\Support\Facades\Schema;
use App\Player;
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


Route::post('/checkurl', 'HomeController@checkurl');

Route::get('/', function () {
  try {
    $streamer = DB::table('featured_streamer')
      ->orderBy('created_at', 'desc')
      ->first();
    $player = Player::find($streamer->player_id);
    return view('home')->with('player', $player);
  } catch (\Exception $e) {
    return view('home');
  }
});

Route::get('/faq', 'FaqController@publicview');

Route::get('/sponsors', 'SponsorController@publicview');

Route::post('/i/createuser', 'InviteController@createuser');
Route::get('/i/{invite}', 'InviteController@join');
Route::get('/p/{player}', 'PlayerController@profile');
Route::get('/p/youtube/{player}', 'PlayerController@getYoutube');

Route::group(['prefix' => 'roster'], function () {
  Route::get('all', 'RosterController@all');
  Route::get('creators', 'RosterController@creators');
  Route::get('streamers', 'RosterController@streamers');
  Route::get('team/{team}', 'RosterController@teams');
});

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
  Route::get('/', 'DashboardController@page');
  Route::post('/invite/join', 'InviteController@accept');
  Route::group(['prefix' => 'player'], function () {
    Route::get('edit', 'PlayerController@edit');
    Route::get('teams', 'PlayerController@teams');
    Route::post('avatar', 'PlayerController@avatar');
    Route::post('update', 'PlayerController@update');
    // Route::post('view', 'PlayerController@update');
  });
  Route::group(['prefix' => 'team', 'middleware' => ['auth.mod']], function () {
    Route::get('view', 'TeamController@view');
    Route::get('fetch', 'TeamController@fetch');
    Route::get('edit/{team}', 'TeamController@edit');
    Route::get('players/{team}', 'TeamController@players');
    Route::get('players/fetch/{team}', 'TeamController@players_fetch');
    Route::post('logo', 'TeamController@logo');
    Route::post('create', 'TeamController@create')->middleware('auth.admin');
    Route::post('update', 'TeamController@update');
    Route::post('delete', 'TeamController@delete')->middleware('auth.admin');
    Route::post('makemod', 'TeamController@makemod');
  });
  Route::group(['prefix' => 'invite', 'middleware' => ['auth.mod']], function () {
    Route::get('view', 'InviteController@view');
    Route::get('fetch', 'InviteController@fetch');
    Route::post('create', 'InviteController@create');
    // Route::post('delete', 'InviteController@delete');
  });
  Route::group(['prefix' => 'faq', 'middleware' => ['auth.admin']], function () {
    Route::get('view', 'FaqController@view');
    Route::get('fetch', 'FaqController@fetch');
    Route::get('edit/{faq}', 'FaqController@edit');
    Route::post('update', 'FaqController@update');
    Route::post('create', 'FaqController@create');
    Route::post('delete', 'FaqController@delete');
  });
  Route::group(['prefix' => 'sponsor', 'middleware' => ['auth.admin']], function () {
    Route::get('view', 'SponsorController@view');
    Route::get('fetch', 'SponsorController@fetch');
    Route::get('edit/{sponsor}', 'SponsorController@edit');
    Route::post('update', 'SponsorController@update');
    Route::post('create', 'SponsorController@create');
    Route::post('delete', 'SponsorController@delete');
    Route::post('image', 'SponsorController@image');
  });
});









//AUTH ROUTES

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

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
