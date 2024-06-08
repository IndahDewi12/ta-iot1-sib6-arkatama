<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.landing');
});

Route::get('/dashboard', function () {
    $data['title'] = 'Dashboard';
    $data['breadcrumbs'][] = [
        'title' => 'Dashboard',
        'url' => route('dashboard')
    ];

    return view('pages.dashboard', $data);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/sensor', function () {
    $data['title'] = 'Sensor';
    $data['breadcrumbs'][] = [
        'title' => 'Sensor',
        'url' => route('sensor.index')
    ];
    return view('pages.sensor', $data);
})->middleware(['auth', 'verified'])->name('sensor.index');

Route::get('/led-control', function () {
    $data['title'] = 'LED Control';
    $data['breadcrumbs'][] = [
        'title' => 'LED Control',
        'url' => route('led-control.index')
    ];
    return view('pages.led-control', $data);
})->middleware(['auth', 'verified'])->name('led-control.index');




// adalah route yang hanya boleh diakses jika sudah login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Users
    Route::get('users', [UserController::class, 'index'])->name('users.index');
});



require __DIR__ . '/auth.php';
