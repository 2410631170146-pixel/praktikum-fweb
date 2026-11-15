
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/reports/sales', [ReportController::class, 'sales'])
    ->name('report.sales');

Route::get('/reports/sales/export', [ReportController::class, 'export'])
    ->name('report.export');
