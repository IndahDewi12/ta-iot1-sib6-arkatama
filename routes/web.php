<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LedController;
use App\Http\Controllers\SensorController;
use App\Service\WhatsappNotificationService;
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

// Route::get('/led', function () {
//     $data['title'] = 'LED Control';
//     $data['breadcrumbs'][] = [
//         'title' => 'LED Control',
//         'url' => route('led.index')
//     ];
//     return view('pages.led', $data);
// })->middleware(['auth', 'verified'])->name('led.index');
Route::controller(LedController::class)->group(function () {
    Route::get('/leds', 'index')->name('led.index');
    Route::post('/leds', 'store')->name('led.store');
});





// adalah route yang hanya boleh diakses jika sudah login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Users
    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('/whatsapp', function () {
        $target = request('target');
        $message = 'Ada kebocoran gas dirumah anda, segera cek sekarang!';
        $response = WhatsappNotificationService::sendMessage($target, $message);

        echo $response;
    });
});



require __DIR__ . '/auth.php';
