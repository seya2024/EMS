<?php

use App\Filament\Pages\Register;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/admin/register', Register::class)->name('filament.admin.register');

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

Route::middleware('auth')->group(function () {
    Route::post('/chat/send', [ChatController::class, 'send']);
    Route::get('/chat/history/{user}', [ChatController::class, 'history']);
    Route::post('/chat/read/{message}', [ChatController::class, 'markRead']);
});
