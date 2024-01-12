<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationSeenController;
use App\Http\Controllers\RealtorAcceptOfferController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\RealtorListingImageController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', [ListingController::class, 'index']);
Route::get('/show', [HomeController::class, 'show'])->name('show.page');

Route::resource('listing', ListingController::class)->only('index', 'show');
// Route::get('/listing/destroy/{listing}', [ListingController::class, 'destroy'])->name('listing.destroy');
Route::resource('listing.offer', ListingOfferController::class)
    ->middleware('auth')
    ->only(['store']);

// notification
Route::resource('notifications', NotificationController::class)->middleware('auth')->only(['index', 'destroy']);

Route::name('notification.seen')
    ->put('notification/{notification}/seen', NotificationSeenController::class)
    ->middleware('auth');

Route::post('notifications/all/delete', [NotificationController::class, 'delete'])
    ->middleware('auth')
    ->name('notifications.all.delete');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

Route::resource('user-account', UserAccountController::class)
    ->only(['create', 'store']);

// email verification
Route::get('/email/verify', function () {
    return inertia('Auth/VerifyEmail');
})->middleware('auth')->name('verification.notice');

// email handle
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('realtor.listing.index')->with('success', 'Your email was verified!');
})->middleware(['auth', 'signed'])->name('verification.verify');

// email resent
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return redirect()->back()->with('success', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

/* For Realtor */


Route::prefix('realtor')
    ->name('realtor.')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::put('listing/{listing}/restore', [RealtorListingController::class, 'restore'])->name('listing.restore')->withTrashed();
        Route::resource('listing', RealtorListingController::class)
            ->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy'])
            ->withTrashed();

        // accept offer
        Route::name('offer.accept')
            ->put('offer/{offer}/accept', RealtorAcceptOfferController::class); // single action controller
        // image
        Route::resource('listing.image', RealtorListingImageController::class)
            ->only(['create', 'store', 'destroy']);
    });











// Route::inertia('/show', 'Show/Show')->name('show.page');

// Route::resource('listing', ListingController::class)
//     ->only(['create', 'store', 'edit', 'update', 'destroy'])
//     ->middleware('auth');

// Route::resource('listing', ListingController::class)
//     ->except([
//         'create', 'store', 'edit', 'update', 'destroy'
//     ]);
