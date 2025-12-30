<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Later you try to define this
Route::get('/home', [HomeController::class, 'index']);

// Route::get('/', function () {
//     return view('home');
// });

// Route::get('/test-email', function () {
//     Mail::raw('This is a test email from Laravel.', function ($message) {
//         $message->to('your-email@example.com') // replace with your email
//             ->subject('Test Email');
//     });

//     return 'Email sent (check your inbox/spam).';
// });
