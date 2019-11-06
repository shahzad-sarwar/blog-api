<?php

Route::post('register', 'Auth\\RegisterController@register');
Route::post('login', 'Auth\\LoginController@login');

Route::apiResource('categories', 'API\\CategoriesController');
Route::apiResource('posts', 'API\\PostsController');
