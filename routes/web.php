<?php

    use App\Http\Controllers\GoogleSheetController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\RecordController;
    use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/records', [RecordController::class, 'index']);
Route::post('/records', [RecordController::class, 'store']);
Route::put('/records/{record}', [RecordController::class, 'update']);
Route::delete('/records/{record}', [RecordController::class, 'destroy']);

Route::post('/records/generate', [RecordController::class, 'generate']);
Route::post('/records/clear', [RecordController::class, 'truncate']);

Route::get('/google-sheets-config', [GoogleSheetController::class, 'index']);
Route::post('/google-sheets-config', [GoogleSheetController::class, 'store']);

require __DIR__.'/auth.php';
