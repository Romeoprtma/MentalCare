<?php
use App\Http\Controllers\MBTIController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\viewController;
use App\Livewire\UserChart;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('components.user.home');
});

Route::get('/meditasi', function () {
    return view('components.user.meditasi');
});

Route::get('/userChart', UserChart::class);

Route::get('/tesKepribadian', [MBTIController::class, 'mbti'])->name('mbti');

Route::get('/printTes', [MBTIController::class, 'printTes']);

// Login Admin
Route::get('/loginAdmin', [loginController::class, 'showLoginAdmin'])->name('loginAdmin');
Route::post('/loginAdmin', [loginController::class, 'loginAdmin']);

// Register Admin
Route::get('/registerAdmin', [loginController::class, 'showRegisterAdmin'])->name('registerAdmin');
Route::post('/registerAdmin', [loginController::class, 'registerAdmin']);

// Menampilkan halaman login
Route::get('/login', [loginController::class, 'showLogin'])->name('login');

Route::post('/logout', [loginController::class, 'logout']);

// Mengelola login dan registrasi
Route::post('/auth', [loginController::class, 'handleAuth']);


Route::middleware(['auth','user-access:user'])->prefix('user')->group(function(){
    Route::get('/home',[viewController::class ,'viewHome']);
    Route::get('/meditasi',[viewController::class, 'viewMeditasi']);
    Route::get('/tesKepribadian', [MBTIController::class, 'mbti'])->name('mbti');
    Route::post('/submit-answers', [MBTIController::class, 'submitAnswers'])->name('submit.answers');

});

Route::get('/psikolog', function(){
    return view('components.listPsikolog');
});

Route::middleware(['auth','user-access:psikolog'])->prefix('psikolog')->group(function(){
    Route::get('/home',[viewController::class ,'viewHome']);
    Route::get('/meditasi',[viewController::class, 'viewMeditasi']);
    Route::get('/tesKepribadian', [viewController::class, 'viewTesKepribadian']);
});

Route::middleware(['auth','user-access:admin'])->prefix('admin')->group(function(){
    Route::get('/homeAdmin',[viewController::class ,'viewHomeAdmin']);
    Route::get('/dashboard',[viewController::class ,'viewDashboardAdmin']);
});
