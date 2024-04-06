<?php

use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::view('admin/profiles', 'profiles-list')->name('admin.profiles')->middleware(isAdmin::class);
    Route::view('business-profile', 'business-profile')->name('business_profile');
    Route::view('invitation/{code}', 'invitation')->name('custom-link');
});


Route::view('/', 'welcome')->name('home');
Route::view('rating/{code}', 'ratings')->name('rating');

