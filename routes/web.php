<?php

use App\Livewire\ExamPage;
use App\Livewire\HomePage;
use App\Livewire\QuestionPage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomePage::class)->name('home');

// Route::get('/exam/{examId}', ExamPage::class)->name('exam.show');
Route::get('/exam/{token}', ExamPage::class)->name('exam.show');
Route::get('/exam/{token}/questions', QuestionPage::class)->middleware('check.exam.status')->name('exam.questions');
