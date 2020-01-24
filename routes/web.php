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

Route::get('/', [
    'uses' => 'BlogController@index',
    'as' => 'home'
]);

Route::get('/about', [
    'uses' => 'BlogController@about',
    'as' => 'about'
]);

Route::get('/contact', [
    'uses' => 'BlogController@contact',
    'as' => 'contact'
]);

Route::get('/post/{post}', [
    'uses' => 'BlogController@show',
    'as' => 'show'
]);

Route::post('/blog/{post}/comments', [
    'uses' => 'CommentController@store',
    'as' => 'blog.comments'
]);

Route::get('/tag/{tag}', [
    'uses' => 'BlogController@tag',
    'as' => 'tag'
]);

Route::get('/category/{category}', [
    'uses' => 'BlogController@category',
    'as' => 'category'
]);

Route::get('/author/{author}', [
    'uses' => 'BlogController@author',
    'as' => 'author'
]);

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/backend', [
    'uses' => 'Backend\HomeController@index',
    'as' => 'backend'
]);

Route::name('backend.')->group(function () {
    Route::resource('/backend/blog', 'Backend\BlogController');
    Route::resource('/backend/category', 'Backend\CategoryController');
    Route::resource('/backend/user', 'Backend\UserController');
});

Route::put('/backend/blog/restore/{post}', [
    'uses' => 'Backend\BlogController@restore',
    'as' => 'backend.blog.restore'
]);

Route::delete('/backend/blog/force-destroy/{post}', [
    'uses' => 'Backend\BlogController@forceDestroy',
    'as' => 'backend.blog.force-destroy'
]);

Route::get('/backend/user/confirm/{user}', [
    'uses' => 'Backend\UsersController@confirm',
    'as' => 'backend.user.confirm'
]);

Route::get('/edit-account', 'Backend\HomeController@edit')->name('edit-account');
Route::put('/edit-account', 'Backend\HomeController@update');