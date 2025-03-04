<?php

use App\Http\Controllers\ReactionController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\MailController;
use App\Http\Middleware\EnsureIsModo;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth');
});

Route::Post("/register", [AuthController::class, "register"]);

Route::get('/login', function() {
    return view('auth');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::Get('/deleteAccount', [AuthController::class, 'removeAccount']);

Route::Get("/dashboard", [BlogController::class, 'index'])->name('dashboard');

Route::Get("/blog/look", [BlogController::class, 'look'])->middleware('auth');

Route::Post("/blog/create", [BlogController::class, 'create'])->middleware('auth');

Route::Get("/article/index/{id}", [ArticleController::class, 'index']);

Route::post('/articles/{article}/comment', [CommentController::class, 'store'])->middleware('auth');

Route::Delete('/article/{article}', [ArticleController::class, 'destroy'])->name('article.destroy')->middleware('auth');

Route::Delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy')->middleware('auth');

Route::post('/comments/{comment}/react', [ReactionController::class, 'store'])->middleware('auth');

Route::Get('/about', function() {
    return view('about');
});

Route::Get('/contact', function() {
    return view('contact');
});

Route::Post("/askQuestion", [MailController::class, "sendEmail"]);

Route::Get("/gestion", [GestionController::class, 'index'])->middleware(EnsureIsModo::class);

Route::Get("/gestion/removeAccount{userId}", [GestionController::class, 'removeAccount']);