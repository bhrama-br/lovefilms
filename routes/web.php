<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TvController;

use App\Http\Controllers\GeneratePPT;

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

Route::get('/', [MoviesController::class, 'index'])->name('index');
Route::get('/movies/{movie}', [MoviesController::class, 'show'])->name('movies.show');
Route::get('/author/{author}', [AuthorController::class, 'show'])->name('author.show');
Route::get('/tv/{id}', [TvController::class, 'show'])->name('tv.show');
Route::get('/search/{search}', [SearchController::class, 'index'])->name('search.index');

Route::get('generateppt/{id}', [GeneratePPT::class, 'generateppt'])->name('export');
