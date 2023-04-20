<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\BookingController;

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BusinessHourController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PaypalPaymentController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ServiceProviderController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\ManageBookingController;
use App\Http\Controllers\Admin\ManageServiceController;
use App\Http\Controllers\Admin\ManageProviderController;
use App\Http\Controllers\Admin\ManageWithdrawController;
use App\Http\Controllers\Admin\ManageSubscriptionController;
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Auth\ForgotPasswordController as AuthForgotPasswordController;


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

            // Manage Service

            Route::get('service', [ManageServiceController::class, 'index'])->name('service');
            Route::get('service/search', [ManageServiceController::class, 'index'])->name('service.search');
            Route::post('service/accept/{service}', [ManageServiceController::class, 'acceptService'])->name('service.accept');
            Route::post('service/reject/{service}', [ManageServiceController::class, 'rejectService'])->name('service.reject');
            // bookings

            Route::get('bookings', [ManageBookingController::class, 'index'])->name('bookings');
            Route::get('bookings/search', [ManageBookingController::class, 'index'])->name('bookings.search');
            Route::get('bookings/completed', [ManageBookingController::class, 'completed'])->name('bookings.completed');
            Route::get('bookings/incomplete', [ManageBookingController::class, 'inCompleted'])->name('bookings.incomplete');
            Route::post('bookings/complete/{booking}', [ManageBookingController::class, 'bookingComplete'])->name('bookings.complete');
            Route::post('bookings/delete/{booking}', [ManageBookingController::class, 'bookingDelete'])->name('bookings.delete');
            Route::get('bookings/job/end', [ManageBookingController::class, 'endJobs'])->name('bookings.end.job');

            Route::post('booking/contract/{booking}', [ManageBookingController::class, 'bookingEndContract'])->name('bookings.end.contract');

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
            Route::post('bookings/complete/{id}', [BookingController::class, 'bookingCompleted'])->name('bookings.complete');

            Route::middleware('service_provider')->group(function () {
                Route::get('service/all', [ServiceProviderController::class, 'index'])->name('service');
                Route::get('service/create', [ServiceProviderController::class, 'createService'])->name('service.create');
                Route::post('service/create', [ServiceProviderController::class, 'storeService']);

                Route::get('service/edit/{service}', [ServiceProviderController::class, 'serviceEdit'])->name('service.edit');
                Route::post('service/edit/{service}', [ServiceProviderController::class, 'serviceUpdate']);
                Route::post('service/delete/{service}', [ServiceProviderController::class, 'serviceDelete'])->name('service.delete');

                Route::get('service/search', [ServiceProviderController::class, 'index'])->name('service.search');

                Route::get('service/schedule', [ServiceProviderController::class, 'schedule'])->name('service.schedule');
                Route::post('service/schedule', [ServiceProviderController::class, 'scheduleCreate']);
                Route::post('service/schedule/{schedule}/update', [ServiceProviderController::class, 'scheduleUpdate'])->name('service.schedule.update');
                Route::post('service/schedule/{schedule}/delete', [ServiceProviderController::class, 'scheduleDelete']);

                Route::get('service/booking', [BookingController::class, 'serviceBooking'])->name('provider.booking');
                Route::get('service/booking/search', [BookingController::class, 'serviceBooking'])->name('provider.booking.search');
                Route::post('service/booking/{booking}/accept', [BookingController::class, 'serviceBookingAccept'])->name('service.booking.accept');
                Route::post('service/booking/{booking}/reject', [BookingController::class, 'serviceBookingReject'])->name('service.booking.reject');
            });
        });
    });


    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('experts', [HomeController::class, 'experts']);

    Route::get('experts/{user}', [HomeController::class, 'userDetails'])->name('service.provider.details');
    Route::get('service/{id}/{slug}', [HomeController::class, 'serviceDetails'])->name('service.details');
    Route::get('search/experts', [HomeController::class, 'searchExperts'])->name('experts.search');
    Route::get('category', [HomeController::class, 'categoryAll'])->name('category.all');
    Route::get('category/{slug}', [HomeController::class, 'categoryDetails'])->name('category.details');


    Route::get('business-hours', [BusinessHourController::class, 'index']);
    Route::post('business-hours', [BusinessHourController::class, 'update'])->name('business_hours.update');
    Route::get('reserve', [AppointmentController::class, 'index']);
    Route::post('reserve', [AppointmentController::class, 'reserve'])->name('reserve');
});
