<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\contact\contactController;
use App\Http\Controllers\home\FlashCardController;
use App\Http\Controllers\home\testController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JishoController;
use App\Http\Controllers\login\loginController;
use App\Http\Controllers\VoiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpeechController;
use App\Http\Controllers\testABCXYZ\balinhtinhController;

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


// thử nghiệm những công nghệ mới
Route::get('/testLivewire', [HomeController::class, 'testLivewire']);


Route::get('/testBalinhtinh', [balinhtinhController::class, 'index']);






Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [HomeController::class, 'login'])->name('login');

Route::get('/forgot-password', [loginController::class, 'forgotPassword'])->name('forgot-password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('post-forgot-password');

// làm đến đây.
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');


Route::post('/home', [loginController::class, 'index'])->name('post-login');

//contact
Route::get('/contact', [contactController::class, 'index'])->name('contact');
Route::post('/contact', [contactController::class, 'postContact'])->name('post-contact');


Route::get('/about', [HomeController::class, 'about'])->name('about');

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

    //test
    Route::get('/test', [testController::class, 'test'])->name('test');
    Route::post('/test', [testController::class, 'postTest'])->name('post-test');
    Route::post('/postLevel', [testController::class, 'postLevel'])->name('post-level');
});

//logout
Route::get('/logout', [loginController::class, 'loguot'])->name('logout');


Route::get('/home', [HomeController::class, 'index'])->name('home');
