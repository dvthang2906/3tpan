<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\Users\UpdateUserDataController;
use App\Http\Controllers\contact\contactController;
use App\Http\Controllers\home\FlashCardController;
use App\Http\Controllers\home\ListenController;
use App\Http\Controllers\home\NewsController;
use App\Http\Controllers\home\testController;
use App\Http\Controllers\home\WriteKanjiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JishoController;
use App\Http\Controllers\login\loginController;
use App\Http\Controllers\VoiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpeechController;
use App\Http\Controllers\testABCXYZ\balinhtinhController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\Users\CheckUserController;
use App\Models\Users\UpdateDataUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

// Microsoft Translator API
Route::get('/translate', [TranslationController::class, 'translate']);






Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [HomeController::class, 'login'])->name('login');

Route::get('/forgot-password', [loginController::class, 'forgotPassword'])->name('forgot-password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('post-forgot-password');

// Route hiển thị form reset mật khẩu
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Route xử lý dữ liệu form
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


// lấy thông tin người dùng
Route::post('/user-information', function (Request $request) {
    try {
        $userName = $request->input('userName');
        $user = DB::table('login_infomation')->where('user', $userName)->first();
        return response()->json($user);
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        return response()->json(['error' => 'Lỗi xảy ra'], 500);
    }
});

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

    // newsRead
    Route::get('/news', [NewsController::class, 'index'])->name('news');

    //API audio
    Route::get('/news', [NewsController::class, 'index'])->name('news');

    // 聴く
    Route::get('/listen', [ListenController::class, 'index'])->name('listen');
    Route::get('/listen/{id}', [ListenController::class, 'listen'])->name('listen-id');

    // 書く
    Route::get('/writeKanji', [WriteKanjiController::class, 'index'])->name('write-kanji');
});

//logout
Route::get('/logout', [loginController::class, 'loguot'])->name('logout');


Route::get('/home', [HomeController::class, 'index'])->name('home');

// Update data User
Route::post('/updateUsers', [UpdateUserDataController::class, 'updateUserID']);

//Update images user table login_infomation
Route::post('/uploadImageUser', [UpdateUserDataController::class, 'updateImages']);

//check data
Route::get('/checkDataExistence', [CheckUserController::class, 'checkDataExistence']);



//ADMIN
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::get('/user', [AdminController::class, 'user'])->name('ad_userCtl');
    Route::get('/data', [AdminController::class, 'data'])->name('ad_dataCtl');
});
