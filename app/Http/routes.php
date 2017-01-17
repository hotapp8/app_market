<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'Index@index');
Route::any('/ajax', 'Index@ajax');
Route::get('/create', 'Index@create');
Route::post('/create', 'Index@store');
Route::get('/show/{id}', 'Index@show');
Route::post('/uploadImage', 'Index@uploadImage');

Route::post('/login', 'User@login');
Route::any('/logout', 'User@logout');
Route::post('/register', 'User@register');

Route::post('/comment', 'Comment@comment');

Route::get('/review', 'Manage@listReview');
Route::post('/review', 'Manage@doReview');

Route::get('/hot', 'Manage@listHot');
Route::post('/hot', 'Manage@editHot');