<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\LocalizationController; 
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('lang/{locale}', [LocalizationController::class, 'index'])->name('lang');


// Route::get('etudiants', [EtudiantController::class, 'index'])->name('etudiants')->middleware('auth');
Route::get('etudiant/{etudiant}', [EtudiantController::class, 'show'])->name('etudiant.show')->middleware('auth');
Route::get('myspace', [EtudiantController::class, 'myspace'])->name('myspace.show')->middleware('auth');

Route::get('etudiant-create', [EtudiantController::class, 'create'])->name('etudiant.create')->middleware('auth');
Route::post('etudiant-store', [EtudiantController::class, 'store'])->name('etudiant.store')->middleware('auth');

Route::get('etudiant-edit/{etudiant}', [EtudiantController::class, 'edit'])->name('etudiant.edit')->middleware('auth');
Route::put('etudiant-edit/{etudiant}', [EtudiantController::class, 'update'])->name('etudiant.update')->middleware('auth');

Route::delete('etudiant/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiant.delete')->middleware('auth');


// ville
Route::get('villes', [VilleController::class, 'index'])->name('indexVilles')->middleware('auth');

// authentification
Route::get('registration', [UserAuthController::class, 'create'])->name('registration');
Route::post('user-registration', [UserAuthController::class, 'store'])->name('user.registration');
Route::get('login', [UserAuthController::class, 'index'])->name('login');
Route::post('user-login', [UserAuthController::class, 'userLogin'])->name('user.login');
Route::get('dashboard', [UserAuthController::class, 'dashboard'])->name('dashboard');
Route::get('logout', [UserAuthController::class, 'logout'])->name('logout')->middleware('auth');

// Forum
Route::get('forum', [ArticleController::class, 'index'])->name('forum')->middleware('auth');

Route::get('article/{article}', [ArticleController::class, 'show'])->name('article.show')->middleware('auth');
Route::get('article-create', [ArticleController::class, 'create'])->name('article.create')->middleware('auth');
Route::post('article-store', [ArticleController::class, 'store'])->name('article.store')->middleware('auth');

Route::get('article-edit/{article}', [ArticleController::class, 'edit'])->name('article.edit')->middleware('auth');
Route::put('article-edit/{article}', [ArticleController::class, 'update'])->name('article.update')->middleware('auth');
Route::delete('article/{article}', [ArticleController::class, 'destroy'])->name('article.delete')->middleware('auth');

// Documents
Route::get('docs', [DocumentController::class, 'index'])->name('docs')->middleware('auth');

Route::get('doc/{document}', [DocumentController::class, 'show'])->name('doc.show')->middleware('auth');
Route::get('doc-create', [DocumentController::class, 'create'])->name('doc.create')->middleware('auth');
Route::post('doc-store', [DocumentController::class, 'store'])->name('doc.store')->middleware('auth');

Route::get('doc-download/{document}', [DocumentController::class, 'download'])->name('doc.download')->middleware('auth');

Route::get('doc-edit/{document}', [DocumentController::class, 'edit'])->name('doc.edit')->middleware('auth');
Route::put('doc-edit/{document}', [DocumentController::class, 'update'])->name('doc.update')->middleware('auth');
Route::delete('doc/{document}', [DocumentController::class, 'destroy'])->name('doc.delete')->middleware('auth');

Route::get('doc-view/{document}', [DocumentController::class, 'viewTheDoc'])->name('doc.view')->middleware('auth');