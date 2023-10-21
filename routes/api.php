<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\Master\ColorController;
use App\Http\Controllers\Api\Master\FrameController;
use App\Http\Controllers\Api\Settings\SettDefaultController;
use App\Http\Controllers\Api\Settings\VoucherController;
use App\Http\Controllers\Api\Gallery\ImageController;
use App\Http\Controllers\Api\Gallery\ListGuestController;
use App\Http\Controllers\Api\Gallery\ListContactController;
use App\Http\Controllers\Api\OyController;
use App\Http\Controllers\Api\CallbackController;
use App\Http\Controllers\Api\Gallery\ImagePrintController;
// use App\Http\Controllers\Api\AnalyticController;
use App\Http\Controllers\Api\PackageController;

Route::post('open/slide', [OyController::class, 'createTransaction']);
Route::post('check-transaction', [OyController::class, 'checkTransaction']);

//api kirim photo setalah klik print//
Route::get('list-image', [ImagePrintController::class, 'index']);
Route::post('send-image', [ImagePrintController::class, 'store']);

//Route::resource('list-guest', ListGuestController::class)->except(['edit', 'create']);
Route::resource('list-contact', ListContactController::class)->except(['edit', 'create']);
//diganti jadi api diatas(list-contact)
Route::resource('gallery', ImageController::class)->except(['edit', 'create']);
Route::get('gallery/qrcode/{code}', [ImageController::class, 'generate'])->name('generate');
Route::get('package/{id}', [PackageController::class, 'index']);

Route::get('color', [ColorController::class, 'index']);
Route::get('frame/{id}', [FrameController::class, 'index']);
Route::get('settings-default/{id}', [SettDefaultController::class, 'index']);

Route::get('voucher', [VoucherController::class, 'index']);
Route::post('voucher/store', [VoucherController::class, 'storeVoucher']);

//API route for register new user
Route::post('/register', [AuthController::class, 'register']);
//API route for login user
Route::post('/login', [AuthController::class, 'login']);
// callback
Route::get('callback/{id}', [CallbackController::class, 'show']);
Route::post('callback', [CallbackController::class, 'store']);
Route::get('callback', [CallbackController::class, 'store']);
Route::post('analytic', [CallbackController::class, 'analytic']);
//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });
    Route::resource('posts', PostController::class)->except(['edit', 'create']);
    Route::resource('blogs', BlogController::class)->except(['edit', 'create']);
    Route::get('callbacks', [CallbackController::class, 'index']);
    // API route for logout user
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
