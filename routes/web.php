<?php

use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

$idRegex = '[0-9]+';
$slugRegex = '[a-z0-9\-]+';

Route::get('/', [HomeController::class, 'index']);
Route::get('/biens', [\App\Http\Controllers\PropertyController::class, 'index'])
    ->name('property.index');
Route::get('/biens/{slug}-{property}', [\App\Http\Controllers\PropertyController::class, 'show'])
    ->name('property.show')
    ->where([
        'slug' => $slugRegex,
        'property' => $idRegex,
    ]);
Route::post('/biens/{property}/contact', [\App\Http\Controllers\PropertyController::class, 'contact'])
    ->name('property.contact')
    ->where([
        'property' => $idRegex,
    ]);

Route::get('/images/{path}', [ImageController::class, 'show'])
    ->where('path', '.*')
    ->name('image.show');


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () use ($idRegex){
    Route::resource('property', PropertyController::class)
    ->except(['show']);
    Route::resource('option', OptionController::class)
        ->except(['show']);
    Route::delete('picture/{picture}', [\App\Http\Controllers\Admin\PictureController::class, 'destroy'])
        ->name('picture.destroy')
        ->where([
            'picture' => $idRegex
        ])
    ->can('delete', 'picture');
});

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->middleware('guest')->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'doLogin'])->middleware('guest');
Route::delete('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth')->name('logout');
