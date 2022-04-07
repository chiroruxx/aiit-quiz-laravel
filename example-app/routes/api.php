<?php

declare(strict_types=1);

use App\Http\Controllers\DailyReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('daily-reports/{report}', [DailyReportController::class, 'show'])->name('daily_reports.show');
Route::post('daily-reports', [DailyReportController::class, 'store'])->name('daily_reports.store');
