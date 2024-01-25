<?php

use App\Http\Controllers\admin\AdminContactController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminNewsController;
use App\Http\Controllers\admin\ExcelController;
use App\Http\Controllers\admin\updateKanjiController;
use App\Http\Controllers\admin\VocabularyController;
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
use App\Http\Controllers\PaymentController;
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


//about
Route::get('/about', [HomeController::class, 'about'])->name('about');

//jisho
Route::get('/jisho-vocabulary', [HomeController::class, 'showVocabulary'])->name('home.show.vocabulary');
Route::get('/jisho-search', [HomeController::class, 'jisho'])->name('home.search.jisho');

//thanh toan Stripe
Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
Route::post('/charge', [PaymentController::class, 'charge']);


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

    Route::get('/add-comment', [JishoController::class, 'postAddComment'])->name('Add-Comment');
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
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::get('/user', [AdminController::class, 'user'])->name('ad_userCtl');
    Route::get('/data', [AdminController::class, 'data'])->name('ad_dataCtl');

    Route::post('/deleteUsers', [AdminController::class, 'deleteUsers'])->name('delete-user');
    Route::post('/addUsers', [AdminController::class, 'addUser'])->name('admin-post-add-users');
    Route::prefix('/data')->group(function () {
        Route::get('/kanji', [AdminController::class, 'kanji'])->name('kanji');
        Route::get('/search-kanji', [AdminController::class, 'searchKanji'])->name('search-kanji');
        Route::get('/news', [AdminNewsController::class, 'show'])->name('show-news');
        Route::post('/news/edit', [AdminNewsController::class, 'edit'])->name('edit-News');
        Route::post('/news/search-news', [AdminNewsController::class, 'searchNews'])->name('search-News');
        Route::get('/news/views/{id}', [AdminNewsController::class, 'detailsNews'])->name('news.details.view');
        Route::delete('/news/delete', [AdminNewsController::class, 'deleteNews'])->name('news.delete');
        Route::post('/news/uploadImage', [AdminNewsController::class, 'updateImages'])->name('news.update.images');
        Route::get('/news/addNews', [AdminNewsController::class, 'addNews'])->name('add-News');
        Route::post('news/addNews', [AdminNewsController::class, 'postAddNews'])->name('news.store');
        Route::get('/test', [AdminNewsController::class, 'getDataTest'])->name('get.data.Test');
        // Route::post('/test', [AdminNewsController::class, 'postDataTest'])->name('post.data.Test');
        Route::get('/test/insertTest', [AdminNewsController::class, 'getListTest'])->name('shows.test');
        Route::post('/test/insertTest', [AdminNewsController::class, 'postInsetDataTest'])->name('post.data.test');
        Route::post('/upload-excel', [ExcelController::class, 'uploadExcel'])->name('upload.excel');

        //VOCABULARY
        Route::get('/vocabulary', [VocabularyController::class, 'showVocabulary'])->name('show.vocabulary');
        Route::get('/SearchByLevel', [VocabularyController::class, 'findByLevel'])->name('search.level.vocabulary');
        Route::post('/vocabulary/create', [VocabularyController::class, 'createVocabulary'])->name('create.vocabulary');
        Route::post('/vocabulary/update', [VocabularyController::class, 'updateVocabulary'])->name('update.vocabulary');
        Route::delete('/vocabulary/delete', [VocabularyController::class, 'deleteVocabulary'])->name('delete.vocabulary');
    });

    //CONTACT
    Route::prefix('/contact')->group(function () {
        Route::get('/showContact', [AdminContactController::class, 'showListContacts'])->name('show.list.contact');
        Route::post('/updateStatusContact', [AdminContactController::class, 'updateStatus'])->name('update.status.contact');
        Route::delete('/deleteContact', [AdminContactController::class, 'deleteContact'])->name('delete.contact');
    });

    Route::post('/update-kanji', [updateKanjiController::class, 'update']);
});
