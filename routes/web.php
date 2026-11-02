
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PosController;

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);

Route::get('/', function () {
    return 'Laravel berhasil dijalankan';
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/badge-test', function () {
    return view('components.badge-test');
});

// Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    $credentials = request()->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        request()->session()->regenerate();

        return redirect()->route('dashboard');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
});

// Logout
Route::post('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');

// Point of Sale (POS)
Route::middleware('auth')->group(function () {

    Route::get('/pos', [PosController::class, 'index'])
        ->name('pos.index');

    Route::post('/pos', [PosController::class, 'store'])
        ->name('pos.store');

    Route::get('/pos/{transaction}/struk', [PosController::class, 'struk'])
        ->name('pos.struk');

    Route::get('/pos/history', [PosController::class, 'riwayatSaya'])
        ->name('pos.history');

});
