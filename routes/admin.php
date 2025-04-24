<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\Dashboard\Auth\LogoutController;
use App\Http\Controllers\Dashboard\Admin\ProfileController;
use App\Http\Controllers\Dashboard\Admin\PortfolioController;
use App\Http\Controllers\Dashboard\MailBox\MailboxController;
use App\Http\Controllers\Dashboard\MailBox\MailReplyController;
use App\Http\Controllers\Dashboard\Settings\SettingsController;
use App\Http\Controllers\DashboardAdminController;


Route::prefix(adminPrefix())->group(function () {

    // Guest
    Route::controller(LoginController::class)->group(function () {
        Route::middleware('guest')->group(function () {
            Route::get('', 'index');
            Route::post('login', 'login')->name("login");
        });
        Route::get('forgot-passowrd', 'forgotPassword');
    });
    /**
     * Admin Middleware
     */
    Route::middleware(['AdminAuth'])->group(function () {
        Route::get('getAllStudent', [HomeController::class, 'getAllStudent'])->name('students.getAllQuestions');

        /*
        | Questions
         */
        Route::prefix('questions')->group(function () {
            Route::controller(QuestionsController::class)->group(function () {
                // All
                Route::get('getAllQuestions', 'getAllQuestions')->name('questions.getAllQuestions');
                // Create
                Route::get('create', 'create')->name('questions.create');
                Route::post('store', 'store')->name("questions.store");
                Route::get('/{question}/edit', [QuestionsController::class, 'edit'])->name('questions.edit');
                Route::put('/{question}', [QuestionsController::class, 'update'])->name('questions.update');
                //Route::delete('{question}', [QuestionsController::class, 'destroy'])->name('questions.destroy');
                Route::delete('{question}', 'destroy')->name("questions.destroy");
            });
        });
        Route::prefix('subjects')->group(function () {
            Route::controller(\App\Http\Controllers\SubjectController::class)->group(function () {
                // All
                //Route::get('getAllQuestions', 'getAllQuestions')->name('questions.getAllQuestions');
                // Create
                Route::get('create', 'create')->name('subjects.create');
                Route::post('store', 'store')->name("subjects.store");
                Route::get('index', 'index')->name("subjects.index");
                Route::get('/{subject}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
                Route::put('/{subject}', [SubjectController::class, 'update'])->name('subjects.update');
                Route::delete('{subjects}', 'destroy')->name("subjects.destroy");
            });
        });




























        ///////////////////////////////////////////////////////////////////////////////////////////
        /*
        |
        | Mailbox
        |
         */
        Route::prefix('mail')->group(function () {

            Route::controller(MailboxController::class)->group(function () {
                Route::get('', 'index');
                Route::get('read/{id}', 'show');
                Route::post('actions', 'multiActions')->name('mail-multi-actions');
                Route::post('load-latest', 'loadLatest');
            });

            // Reply
            Route::controller(MailReplyController::class)->group(function () {
                Route::post('reply', 'store')->name('reply-mail');
                Route::get('show/reply/{id}', 'show');
            });
        });


        /*
        |
        | Settings
        |
         */
        Route::prefix('settings')->group(function () {
            Route::controller(SettingsController::class)->group(function () {
                Route::get('', 'index');
                // General
                Route::post('store', 'store')->name('store-settings');
            });
        });


        /*
        |
        | Admins & Profile
        |
        */
        Route::prefix('profile')->group(function () {   // Admin Profile

            // Profile
            Route::controller(ProfileController::class)->group(function () {

                Route::get('show/{id?}', 'show'); // Show Profile
                Route::get('edit', 'edit');

                // Update
                Route::patch('update-personal-data', 'updatePersonalData')->name('update-personal-data');
                Route::patch('change-password', 'changeProfilePassword')->name('change-profile-password');

                /**
                 * Not Complate
                 */
                Route::post('experience', 'experience')->name('experience');
                /**
                 * Not Complate
                 */

                Route::post('update-avatar', 'updateProfileAvatar')->name('update-profile-avatar');
                Route::patch('update-cover', 'updateProfileCover')->name('update-profile-cover');

                /**
                 * Not Complate
                 */
                // Delete Experience
                Route::delete('delete-experience', 'destroyExperience');
                /**
                 * Not Complate
                 */

                // Verified Email
                Route::post('verify-email', 'sendMailForVerifyEmail')->name('sendMailForVerifyEmail');
                Route::get('verified-email/{token}', 'verifiedEmail');


                // Forgot Password
                Route::post('forgot-password', 'forgotPassword'); // Send Mail
                Route::get('reset-password/{token}', 'resetPasswordView'); // View To Reset
                Route::patch('reset-password', 'resetPasswordUpdate')->name('reset-admin-password'); // Update


                // Update Roles
                Route::patch('change-roles', 'changeRoles')->name('change-roles');
            });

            // Portfolio
            Route::controller(PortfolioController::class)->group(function () {
                Route::patch('portfolio-update', 'update')->name('portfolio-update');
            });
        });
        Route::prefix('admins')->group(function () {
            Route::controller(AdminController::class)->group(function () {
                Route::get('', 'index');
                Route::post('search', 'search')->name("admin-search");
                // Create New Admin
                Route::post('store', 'store')->name("create-admin");

                // Status
                Route::patch('closed-account', 'closedAccount')->name("closed-admin-account");
                Route::patch('active-account', 'activeAccount')->name("active-admin-account");


                // Global Actions From Admins By Owner
                Route::middleware('role:' . owner())->group(function () {
                    Route::delete('destroy', 'destroy')->name("delete-admin");
                });
            });

            Route::middleware('role:' . owner())->group(function () {
                // Edit
                Route::get('edit/{id}', [ProfileController::class, 'edit']);
                // Chnage Other Admin Password By Owner
                Route::patch('change-admin-password', [AdminController::class, 'changeAdminPassword'])->name("change-admin-password");
            });
        });


        // Logout
        Route::post('logout', [LogoutController::class, 'logout'])->name("logout");
        // Home
        Route::controller(HomeController::class)->group(function () {
            Route::get('home', 'index');
        });
    });
});
