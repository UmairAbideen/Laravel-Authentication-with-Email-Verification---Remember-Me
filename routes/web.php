<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});


// Registration Routes with guest middleware to prevent authenticated users from accessing the register page
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Login Routes with guest middleware to prevent authenticated users from accessing the login page
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Authenticated Routes (Dashboard and Logout)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});



// Email Verification Routes

// Route to show the verification notice page
// This page tells the user to check their email for the verification link
Route::get('/email/verify', function () {
    return view('auth.verify-email'); // Blade view that prompts user to verify their email
})->middleware('auth') // Only allow logged-in users to access this route
    ->name('verification.notice'); // Named route for redirection after registration


// R]oute that handles the actual email verification link
// Laravel generates a signed URL with id + hash that hits this route
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); // Marks the user's email as verified in the database
    return redirect()->route('dashboard'); // Redirects to dashboard after successful verification
})->middleware(['auth', 'signed']) // Requires user to be authenticated and URL to be signed (for security)
    ->name('verification.verify'); // Named route used by the email link


// Route to resend the email verification link
Route::post('/email/verification-notification', function (Request $request) {
    // Sends a new email verification notification to the logged-in user
    $request->user()->sendEmailVerificationNotification();

    // Redirects back with a session flash message saying link was sent
    return back()->with('status', 'Verification link sent!');
})->middleware(['auth', 'throttle:2,1'])
    // Only allow authenticated users and throttle requests to max 2 per minute
    ->name('verification.send'); // Used when submitting the resend verification form
