<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

//home route
Route::get('/', function () {
    return view('home', []);
})->name('home');

Route::prefix('profile')->group(function () {
    Route::get('/info', 'ProfileController@index')->name('profile.profile');
    Route::post('/info', 'ProfileController@updateProfile')->name('profile.profile.update');

    Route::get('/security', 'ProfileController@security')->name('profile.security');
    Route::post('/security', 'ProfileController@updateSecurity');

    Route::get('/plan', 'ProfileController@myPlan')->name('profile.plan');
    Route::post('/cancel-plan', 'ProfileController@cancelPlan')->name('cancelPlan');

    Route::get('/payments', 'ProfileController@payments')->name('profile.payments');
});

//check if auth mode is enabled
Route::middleware('checkAuthMode')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
});

//admin routes
Route::middleware(['auth', 'checkAdmin'])->group(function () {

    // Payment Listing
    Route::get('transaction', [App\Http\Controllers\TransactionController::class, 'index'])->name('admin.transaction');

    Route::get('admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::get('update', [App\Http\Controllers\AdminController::class, 'update'])->name('update');
    Route::get('check-for-update', [App\Http\Controllers\AdminController::class, 'checkForUpdate']);
    Route::get('download-update', [App\Http\Controllers\AdminController::class, 'downloadUpdate']);
    Route::get('license', [App\Http\Controllers\AdminController::class, 'license'])->name('license');
    Route::get('verify-license', [App\Http\Controllers\AdminController::class, 'verifyLicense']);
    Route::get('uninstall-license', [App\Http\Controllers\AdminController::class, 'uninstallLicense']);
    Route::get('signaling', [App\Http\Controllers\AdminController::class, 'signaling'])->name('signaling');
    Route::get('check-signaling', [App\Http\Controllers\AdminController::class, 'checkSignaling']);

    //meeting routes
    Route::get('meetings', [App\Http\Controllers\MeetingController::class, 'index'])->name('meetings');
    Route::post('update-meeting-status', [App\Http\Controllers\MeetingController::class, 'updateMeetingStatus']);
    Route::post('delete-meeting-admin', [App\Http\Controllers\MeetingController::class, 'deleteMeeting']);

    //user routes
    Route::get('users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
    Route::post('update-user-status', [App\Http\Controllers\UserController::class, 'updateUserStatus']);
    Route::post('delete-user', [App\Http\Controllers\UserController::class, 'deleteUser']);
    Route::get('users/create', [App\Http\Controllers\UserController::class, 'createUserForm'])->name('createUser');
    Route::post('create-user', [App\Http\Controllers\UserController::class, 'createUser'])->name('storeUser');

    //global config routes
    Route::get('global-config', [App\Http\Controllers\GlobalConfigController::class, 'index'])->name('global-config');
    Route::get('global-config/edit/{id}', [App\Http\Controllers\GlobalConfigController::class, 'edit']);
    Route::post('update-global-config', [App\Http\Controllers\GlobalConfigController::class, 'updateBasic'])->name('basic.update');
    Route::get('global-config/application', [App\Http\Controllers\GlobalConfigController::class, 'application'])->name('global-config.application');
    Route::post('global-config/application', [App\Http\Controllers\GlobalConfigController::class, 'updateApplication'])->name('application.update');
    Route::get('global-config/networking', [App\Http\Controllers\GlobalConfigController::class, 'networking'])->name('global-config.networking');
    Route::post('global-config/networking', [App\Http\Controllers\GlobalConfigController::class, 'updateNetworking'])->name('networking.update');
    Route::get('global-config/meeting', [App\Http\Controllers\GlobalConfigController::class, 'meeting'])->name('global-config.meeting');
    Route::post('global-config/meeting', [App\Http\Controllers\GlobalConfigController::class, 'updateMeeting'])->name('meeting.update');

    //content routes
    Route::get('content', [App\Http\Controllers\ContentController::class, 'index'])->name('content');
    Route::get('content/edit/{id}', [App\Http\Controllers\ContentController::class, 'edit']);
    Route::post('update-content', [App\Http\Controllers\ContentController::class, 'update'])->name('updateContent');

    //languages routes
    Route::get('languages', [App\Http\Controllers\LanguagesController::class, 'index'])->name('languages');
    Route::get('languages/add', [App\Http\Controllers\LanguagesController::class, 'create']);
    Route::post('create-language', [App\Http\Controllers\LanguagesController::class, 'createLanguage'])->name('createLanguage');
    Route::get('languages/edit/{id}', [App\Http\Controllers\LanguagesController::class, 'edit']);
    Route::post('update-language', [App\Http\Controllers\LanguagesController::class, 'updateLanguage'])->name('updateLanguage');
    Route::post('languages/delete', [App\Http\Controllers\LanguagesController::class, 'deleteLanguage']);
    Route::get('languages/download-english', [App\Http\Controllers\LanguagesController::class, 'downloadEnglish']);
    Route::get('languages/download-file/{code}', [App\Http\Controllers\LanguagesController::class, 'downloadFile']);

    // Coupons Routes
    Route::get('/coupons', [App\Http\Controllers\CouponController::class, 'index'])->name('admin.coupons');
    Route::get('/coupons/new', [App\Http\Controllers\CouponController::class, 'create'])->name('admin.coupons.new');
    Route::get('/coupons/{id}/edit', [App\Http\Controllers\CouponController::class, 'edit'])->name('admin.coupons.edit');
    Route::post('/coupons/new', [App\Http\Controllers\CouponController::class, 'store']);
    Route::post('/coupons/{id}/edit', [App\Http\Controllers\CouponController::class, 'update']);
    Route::post('/update-coupon-status', [App\Http\Controllers\CouponController::class, 'updateStatus']);

    // Plans routes
    Route::get('/plans', [App\Http\Controllers\PlanController::class, 'index'])->name('admin.plans');
    Route::get('/plans/new', [App\Http\Controllers\PlanController::class, 'create'])->name('admin.plans.new');
    Route::get('/plans/{id}/edit', [App\Http\Controllers\PlanController::class, 'edit'])->name('admin.plans.edit');
    Route::post('/plans/new', [App\Http\Controllers\PlanController::class, 'store']);
    Route::post('/plans/{id}/edit', [App\Http\Controllers\PlanController::class, 'update']);
    Route::post('/update-plan-status', [App\Http\Controllers\PlanController::class, 'updateStatus']);

    // Tax Rates routes
    Route::get('/tax-rates', [App\Http\Controllers\TaxRateController::class, 'index'])->name('admin.tax_rates');
    Route::get('/tax-rates/new', [App\Http\Controllers\TaxRateController::class, 'create'])->name('admin.tax_rates.new');
    Route::get('/tax-rates/{id}/edit', [App\Http\Controllers\TaxRateController::class, 'edit'])->name('admin.tax_rates.edit');
    Route::post('/tax-rates/new', [App\Http\Controllers\TaxRateController::class, 'store']);
    Route::post('/tax-rates/{id}/edit', [App\Http\Controllers\TaxRateController::class, 'update']);
    Route::post('/update-tax-rates-status', [App\Http\Controllers\TaxRateController::class, 'updateStatus']);

    // Payment process routes
    Route::get('/payment-gateways', [App\Http\Controllers\GlobalConfigController::class, 'paymentGateways'])->name('admin.payment_gateways');
    Route::post('/payment-gateways', [App\Http\Controllers\GlobalConfigController::class, 'updatePaymentGateways']);
});

// Checkout routes
Route::middleware(['auth', 'checkPaymentMode'])->prefix('checkout')->group(function () {
    Route::get('/cancelled', 'CheckoutController@cancelled')->name('checkout.cancelled');
    Route::get('/pending', 'CheckoutController@pending')->name('checkout.pending');
    Route::get('/complete', 'CheckoutController@complete')->name('checkout.complete');

    Route::get('/{id}', 'CheckoutController@index')->name('checkout.index');
    Route::post('/{id}', 'CheckoutController@process');
});

Route::get('/pricing', [App\Http\Controllers\PricingController::class, 'index'])->name('pricing');

//change password
Route::get('change-password', [App\Http\Controllers\ChangePasswordController::class, 'index'])->name('changePassword');
Route::post('update-password', [App\Http\Controllers\ChangePasswordController::class, 'changePassword']);

//general routes
Route::post('create-meeting', [App\Http\Controllers\DashboardController::class, 'createMeeting']);
Route::post('delete-meeting', [App\Http\Controllers\DashboardController::class, 'deleteMeeting']);
Route::post('edit-meeting', [App\Http\Controllers\DashboardController::class, 'editMeeting']);
Route::post('send-invite', [App\Http\Controllers\DashboardController::class, 'sendInvite']);
Route::get('get-invites', [App\Http\Controllers\DashboardController::class, 'getInvites']);
Route::get('meeting/{id}', [App\Http\Controllers\DashboardController::class, 'meeting']);
Route::get('widget', [App\Http\Controllers\DashboardController::class, 'widget']);
Route::post('check-meeting', [App\Http\Controllers\DashboardController::class, 'checkMeeting']);
Route::post('check-meeting-password', [App\Http\Controllers\DashboardController::class, 'checkMeetingPassword']);
Route::post('get-details', [App\Http\Controllers\DashboardController::class, 'getDetails']);
Route::get('languages/{locale}', [App\Http\Controllers\DashboardController::class, 'setLocale'])->name('language');

//extra routes
Route::get('privacy-policy', function () {
    return view('privacy-policy', [
        'page' => __('Privacy Policy'),
    ]);
})->name('privacyPolicy');

Route::get('terms-and-conditions', function () {
    return view('terms-and-conditions', [
        'page' => __('Terms & Conditions'),
    ]);
})->name('termsAndConditions');


// Webhook routes
Route::post('webhooks/stripe', [App\Http\Controllers\WebhookController::class, 'stripe'])->name('webhooks.stripe');
Route::post('webhooks/paypal', [App\Http\Controllers\WebhookController::class, 'paypal'])->name('webhooks.paypal');
