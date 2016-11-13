<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/charts/{name}', function ($name) {
    
    $name = str_replace(':', '/', $name);
    $filePath = "../resources/lttng-parser/result/{$name}";
    return file_get_contents($filePath);
});

