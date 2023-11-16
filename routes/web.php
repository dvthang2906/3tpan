<?php

use App\Http\Controllers\home\FlashCardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JishoController;
use App\Http\Controllers\login\loginController;
use App\Http\Controllers\VoiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpeechController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [HomeController::class, 'login'])->name('login');

Route::post('/home', [loginController::class, 'index'])->name('post-login');

//users
Route::prefix('/users')->group(function () {
    // Route::get('/Signup', [loginController::class, 'Signup'])->name('Signup');
    Route::post('/Signup', [loginController::class, 'postSingup'])->name('post-Signup');
});

Route::prefix('/home')->group(function () {
    Route::get('/voice', [VoiceController::class, 'voice'])->name('voice');
    Route::get('/read', [VoiceController::class, 'read'])->name('read');
    Route::get('/translate', [JishoController::class, 'translate']);

    Route::get('/jisho-search', [JishoController::class, 'jishoSearch'])->name('jisho-search');
    Route::post('/jisho-search', [JishoController::class, 'postJishoSearch'])->name('post-jisho-search');

    Route::get('/add-comment', [JishoController::class, 'postAddComment'])->name('post-Add-Comment');
    Route::post('/add-comment', [JishoController::class, 'postAddComment'])->name('post-Add-Comment');

    //flashCard
    Route::get('/flashcards', [FlashCardController::class, 'index'])->name('flashcards');
    Route::post('/flashcards', [FlashCardController::class, 'index'])->name('post-flashcards');


    Route::post('/getCurrentFlashcard', [FlashCardController::class, 'getCurrentFlashcard']);

    Route::post('/update-learned-status', [FlashCardController::class, 'updateLearnedStatus']);
    Route::post('/delete-learned-status', [FlashCardController::class, 'deleteLearnedVocabulary']);

    Route::get('/ReviewLearned', [FlashCardController::class, 'ReviewLearned'])->name('reviewLearned');
    Route::post('/ReviewLearned', [FlashCardController::class, 'ReviewLearnedFlashcard'])->name('post-reviewLearnedFlashcard');

    Route::post('/update-status-reviewlearned', [FlashCardController::class, 'updateStatus']);


    //pronunciation
    Route::get('/pronunciation', [VoiceController::class, 'pronunciation'])->name('pronunciation');
    // API Google Cloud Text-to-Speech
    Route::post('/synthesize-speech', [SpeechController::class, 'synthesize']);
    Route::post('/upload-audio', [SpeechController::class, 'uploadAudio']);
});

//logout
Route::get('/logout', [loginController::class, 'loguot'])->name('logout');


Route::get('/home', [HomeController::class, 'index'])->name('home');
