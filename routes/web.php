<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AiChatController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RecruitmentController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about.index');

Route::get('/rekrutmen', [RecruitmentController::class, 'index'])->name('recruitment.index');
Route::get('/rekrutmen/daftar', [RecruitmentController::class, 'create'])->name('recruitment.create');
Route::post('/rekrutmen', [RecruitmentController::class, 'store'])->name('recruitment.store');

Route::get('/cabang', [BranchController::class, 'index'])->name('branch.index');
Route::get('/cabang/{branch}', [BranchController::class, 'show'])->name('branch.show');

Route::get('/divisi/{division}', [DivisionController::class, 'show'])->name('division.show');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{blog:slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/kontak', [ContactController::class, 'index'])->name('contact.index');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');

Route::get('/asisten-ai', [AiChatController::class, 'index'])->name('ai.index');
Route::post('/ai/chat', [AiChatController::class, 'chat'])
    ->middleware('throttle:20,1')
    ->name('ai.chat');

//trigger deploy
//trigger deploy
