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
Route::get('/sitemap.xml', 'SitemapController@index');
Route::get('logout' , "LoginController@logout");
Route::get('login' , "LoginController@login");
Route::post('login_post' , "LoginController@login_post_action");
Route::post('contact_send','Homecontroller@contact_send');
Route::get("sign-up" , "LoginController@sign_up");
Route::post('signup_post' , "LoginController@signup_post");

Route::get('js_admin/{page?}/{p1?}', "Admin@index");
Route::get('dashboard/{pages?}/{p1?}' , "Dashboard@index");
Route::post('js_admin/{action}', "Admin@post_action");
Route::get('post/{page_title?}', "Homecontroller@post");
Route::get('/{page?}', "Homecontroller@index");
