<?php

use App\Core\Router\Route;

return [
    Route::get('/home', [App\Controllers\HomeController::class, 'index']),
    Route::get('/movies', [App\Controllers\MovieController::class, 'index']),
    Route::get('/admin/movies/add', [App\Controllers\MovieController::class, 'add']),
    Route::post('/admin/movies/add', [App\Controllers\MovieController::class, 'store']),

];
