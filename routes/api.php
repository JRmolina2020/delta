<?php

use Illuminate\Support\Facades\Route;

Route::post('auth/login', 'Api\AuthController@login');
Route::post('auth/register', 'Api\AuthController@register');
Route::group([
    'middleware' => 'jwt.verify',
], function ($router) {
    Route::group(["prefix" => "auth"], function () {
        Route::post('logout', 'Api\AuthController@logout');
        Route::post('refresh', 'Api\AuthController@refresh');
        Route::post('me', 'Api\AuthController@me');
    });
});

Route::group([
    'middleware' => 'jwt.verify'
], function ($router) {
    Route::resource('categorie', 'Api\\CategorieController')->except([
        'create', 'edit'
    ]);
    Route::put('categorie/activar/{id}', 'Api\\CategorieController@available');
    Route::put('categorie/desactivar/{id}', 'Api\\CategorieController@locked');
});
