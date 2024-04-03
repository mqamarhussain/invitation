<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::view('admin/profiles', 'profiles-list')->name('admin.profiles');
});


Route::view('business-profile', 'business-profile')->name('business_profile');
Route::view('/', 'business-profile')->name('business_profile');
Route::view('invitation/{code}', 'invitation')->name('custom-link');
Route::view('rating/{code}', 'ratings')->name('rating');


Route::get('/sparkpost', function () {


    $response = Http::withHeaders([
        'Authorization' => 'AccessKey '.env('SPARKPOST_SECRET'),
        'Content-Type' => 'application/json',
    ])->post('https://nest.messagebird.com/workspaces/a2627806-06b9-4a82-836d-d68b57f9141f/channels/e2d5cf4b-8971-4bec-a29a-3a11c39e7126/messages', [
        'receiver' => [
            'contacts' => [
                ['identifierValue' => 'lovomo3403@acentni.com']
            ]
        ],
        'body' => [
            'type' => 'html',
            'html' => [
                'metadata' => [
                    'subject' => 'Hello!'
                ],
                'html' => '<p>Congratulations Aileen Spencer, you just sent an email with Bird! You are truly awesome!</p>',
                'text' => 'Congratulations Aileen Spencer, you just sent an email with Bird! You are truly awesome!'
            ]
        ]
    ]);

    // Handle response
    if ($response->successful()) {
        // Success handling
        $responseData = $response->json();
        dd('success', $responseData);
        // Do something with $responseData
    } else {
        // Error handling
        $errorMessage = $response->body();
        dd('error', $errorMessage);
        // Handle error message
    }
});
