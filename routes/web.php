<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\BookingController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BusinessHourController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ServiceProviderController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\ManageBookingController;
use App\Http\Controllers\Admin\ManageServiceController;
use App\Http\Controllers\Admin\ManageProviderController;
use App\Http\Controllers\Auth\LoginController as AuthLoginController;


Route::middleware('demo')->group(function () {
    Route::get('/admin', function () {
        return redirect()->route('admin.login');
    });

    Route::name('admin.')->prefix('admin')->group(function () {

        Route::get('login', [LoginController::class, 'login'])->name('login');
        Route::post('login', [LoginController::class, 'loggedIn'])->withoutMiddleware('demo');


        Route::middleware(['admin'])->group(function () {
            Route::get('dashboard', [AdminController::class, 'home'])->name('dashboard');
            Route::get('logout', [LoginController::class, 'logout'])->name('logout');
            Route::get('profile', [AdminController::class, 'profile'])->name('profile');
            Route::post('profile', [AdminController::class, 'profileUpdate'])->name('profile.update');
            Route::get('login/setting', [AdminController::class, 'loginPage'])->name('login.setting');
            Route::post('login/setting', [AdminController::class, 'loginPageUpdate']);
            Route::post('change/password', [AdminController::class, 'changePassword'])->name('change.password');
            Route::get('business-hours', [BusinessHourController::class, 'index']);
            Route::get('reserve', [AppointmentController::class, 'index']);

            // Doctors

            Route::get('providers', [ManageProviderController::class, 'index'])->name('provider');
            Route::post('provider/update/{provider}', [ManageProviderController::class, 'providerUpdate'])->name('provider.update');
            Route::get('providers/details/{provider}', [ManageProviderController::class, 'providerDetails'])->name('provider.details');
            Route::get('providers/search', [ManageProviderController::class, 'index'])->name('provider.search');
            Route::get('providers/featured', [ManageProviderController::class, 'featuredProvider'])->name('provider.featured');

            // User

            Route::get('users', [ManageUserController::class, 'index'])->name('user');
            Route::get('users/details/{user}', [ManageUserController::class, 'userDetails'])->name('user.details');
            Route::post('users/update/{user}', [ManageUserController::class, 'userUpdate'])->name('user.update');
            Route::get('users/search', [ManageUserController::class, 'index'])->name('user.search');
            Route::get('users/disabled', [ManageUserController::class, 'disabled'])->name('user.disabled');

            // bookings

            Route::get('bookings', [ManageBookingController::class, 'index'])->name('bookings');
            Route::get('bookings/search', [ManageBookingController::class, 'index'])->name('bookings.search');

            // Category
            Route::resource('category', CategoryController::class);
        });
    });


    Route::name('user.')->prefix('user')->group(function () {

        Route::middleware('guest')->group(function () {
            Route::get('register', [RegisterController::class, 'index'])->name('register');
            Route::post('register', [RegisterController::class, 'register']);

            Route::get('login', [AuthLoginController::class, 'index'])->name('login');
            Route::post('login', [AuthLoginController::class, 'login'])->withoutMiddleware('demo');
        });


        Route::middleware(['auth', 'profile_is_update', 'inactive'])->group(function () {
            Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
            Route::get('logout', [RegisterController::class, 'signOut'])->name('logout')->withoutMiddleware('profile_is_update');

            Route::get('profile/setting', [UserController::class, 'profile'])->name('profile')->withoutMiddleware('profile_is_update');
            Route::post('profile/setting', [UserController::class, 'profileUpdate'])->withoutMiddleware('profile_is_update');

            Route::get('change/password', [UserController::class, 'changePassword'])->name('change.password');
            Route::post('change/password', [UserController::class, 'changePasswordUpdate']);

            Route::post('booking/{service}', [BookingController::class, 'booking'])->name('booking');

            Route::get('bookings', [BookingController::class, 'allBookings'])->name('bookings');
            Route::get('bookings/search', [BookingController::class, 'allBookings'])->name('bookings.search');
           
          
        });
    });


    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('experts', [HomeController::class, 'experts']);

    Route::get('experts/{user}', [HomeController::class, 'userDetails'])->name('service.provider.details');
    Route::get('service/{id}/{slug}', [HomeController::class, 'serviceDetails'])->name('service.details');
    Route::get('search/experts', [HomeController::class, 'searchExperts'])->name('experts.search');


    Route::post('business-hours', [BusinessHourController::class, 'update'])->name('business_hours.update');
    Route::post('reserve', [AppointmentController::class, 'reserve'])->name('reserve');
});
