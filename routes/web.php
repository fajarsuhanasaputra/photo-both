<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
//Booth//
use Illuminate\Support\Facades\Artisan;
//User Management//
use App\Http\Controllers\HomeController;
//Master Data//
use App\Http\Controllers\Admin\Booth\BoothController;
//Setting//
use App\Http\Controllers\Admin\Master\ColorController;
use App\Http\Controllers\Admin\Master\FrameController;
use App\Http\Controllers\Admin\Gallery\ImageController;
//profile//
use App\Http\Controllers\Admin\Accont\ProfileController;
use App\Http\Controllers\Admin\Management\UserController;
use App\Http\Controllers\Admin\Package\PackageController;
//use App\Http\Controllers\Admin\Management\GuestController;
use App\Http\Controllers\Admin\Setting\VoucherController;
// use App\Http\Controllers\Admin\Analytic\AnalyticController;
use App\Http\Controllers\Admin\Setting\BuyXGetYController;
//Transaction//
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Setting\SettDefaultController;
use App\Http\Controllers\Admin\Management\ListGuestController;
use App\Http\Controllers\Admin\Management\ListContactsController;
use App\Http\Controllers\Admin\Transaction\FreeTransactionController;
use App\Http\Controllers\Admin\Transaction\TransactionController;

Route::get('/clear', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    return 'Config cache cleared';
});

Route::get('/check', [HomeController::class, 'check'])->name('check');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pulsa', function () {
    return view('pulsa');
});

Auth::routes();

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::post('/home-create', [DashboardController::class, 'index'])->name('home-create');

    //Profile//
    Route::get('/my-profile', [ProfileController::class, 'my_profile'])->name('my-profile');
    Route::put('/my-profile/update/{id}', [ProfileController::class, 'update_profile'])->name('update-profile');
    //Change Password//
    Route::get('/change-password', [ProfileController::class, 'change_password'])->name('change-password');
    Route::post('/update-password', [ProfileController::class, 'update_password'])->name('update-password');
    //User Management//
    Route::resource('/booth', BoothController::class);
    Route::resource('/transaction', TransactionController::class);
    Route::resource('/freetransaction', FreeTransactionController::class);
    // Route::resource('/analytic', AnalyticController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/package', PackageController::class);
    //Master Data//
    Route::resource('/color', ColorController::class);
    Route::resource('/frame', FrameController::class);
    //Setting//
    Route::resource('/voucher', VoucherController::class);
    Route::post('/coupon', [VoucherController::class, 'coupon'])->name('coupon.store');

    Route::resource('/settings-default', SettDefaultController::class)->only('index', 'update');
    Route::resource('/buy-x-get-y', BuyXGetYController::class);

    //Route::resource('/guest', GuestController::class);
    //Route::resource('/guest', GuestController::class);

    // Route::get('gallery/qrcode/{id}', [ImageController::class, 'generate'])->name('generate.img');

    //New
    Route::resource('/list-contact', ListContactsController::class);
    Route::post('/list-contact-download', [ListContactsController::class, 'exportxls'])->name('list-contact-download');;
    //Route::resource('/list-guest', ListGuestController::class);
});
