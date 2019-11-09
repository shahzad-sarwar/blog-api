<?php
Route::get('testing', function() {
    return 'a';
});
// Auth
Route::post('register', 'Auth\\RegisterController@register');
Route::post('login', 'Auth\\LoginController@login');
// Blog Routes
Route::apiResource('categories', 'API\\CategoriesController');
Route::apiResource('posts', 'API\\PostsController');

// Admin Routes
Route::apiResource('admin/users', 'API\\UserController');
Route::get('admin/roles', 'API\\RolesController@index');


