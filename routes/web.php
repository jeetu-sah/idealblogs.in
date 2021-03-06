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




Route::middleware(['web','isLoggedIn'])->group(function () {
    //Route::get('loginnew' , "LoginController@loginnew")->name('loginnew');
    Route::get('login' , "LoginController@login")->name('login');
    Route::get("sign-up" , "LoginController@sign_up");
    Route::post('signup_post' , "LoginController@signup_post");
    Route::post('login_post' , "LoginController@login_post_action");
});

Route::middleware(['web','auth'])->group(function () {
    Route::get('logout' , "LoginController@logout");
    Route::get('dashboard/{pages?}/{p1?}' , "Dashboard@index");

    Route::name('seoManagement.')->group(function () {
        Route::post('saveUrl','SeoManagement@saveUrl')->name('saveUrl');
        Route::post('editSeoManage','SeoManagement@editSeoManage')->name('editSeoManage');
        Route::get('urlList','SeoManagement@urlList')->name('urlList');
    });

    Route::get('admin/removePost/{postID}','Dashboard@removePost');

    Route::name('admin.')->group(function () {

        Route::get('postList','Dashboard@postList')->name('postList');
        Route::get('pageList','Dashboard@pageList')->name('pageList');
        Route::post('savePost','Dashboard@savePost')->name('savePost');
        Route::post('editPost','Dashboard@editPost')->name('editPost');
        Route::post('savePage','Dashboard@savePage')->name('savePage');
    });
   
});

Route::middleware(['web'])->group(function () {
    Route::get('/sitemap.xml', 'SitemapController@index');
    Route::get('about-us','Homecontroller@aboutUs');
    Route::get('dmca-policy','Homecontroller@dmcaPolicy');
    Route::get('privacy-policy','Homecontroller@privacyPolicy');
	Route::get('term-and-condition','Homecontroller@termAndCondition');
    Route::post('contact_send','Homecontroller@contact_send');
	
    
    // Route::name('posts.')->group(function () {
    //     Route::post('uploadVideos','Post\PostController@uploadVideos')->name('uploadVideos');
    // });
    // Route::get('js_admin/admin', "Admin@pages");
    // Route::get('js_admin/{page?}/{p1?}', "Admin@index");
    
   // Route::post('js_admin/{action}', "Admin@post_action");
   
    Route::get('post/{page_title?}', "Homecontroller@post");
    Route::get('/category/{page?}', "Homecontroller@category");
    Route::get('/{page?}', "Homecontroller@index");
 

});






