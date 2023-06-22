<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/home', [MovieController::class, 'movie'])->name('home');
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');
Route::middleware('web')->group(function () {
Route::get('/',[AuthManager::class,'login'])->name('login');
Route::post('/login',[AuthManager::class,'loginPost'])->name('login.post');
});
Route::get('/movies', 'MovieController@getMovies')->name('movies');
Route::get('/register', [AuthManager::class, 'register'])->name('registration');
Route::post('/register', [AuthManager::class, 'registerPost'])->name('registration.post');
Route::get('/logout',[AuthManager::class,'logout'])->name('logout');
Route::get('/search', [MovieController::class, 'search'])->name('search');


Route::get('/movies/{id}', [MovieController::class,'show'])->name('movies.show');
Route::get('/cabinet', [UserController::class,'cabinet'])->name('user.cabinet');
Route::post('/movies/{movie}', [MovieController::class, 'watched']);
Route::get('/categories/{category}', [CategoryController::class, 'moviesByCategory'])->name('categories.movies');