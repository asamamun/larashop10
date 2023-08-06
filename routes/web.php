<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributesetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',[DashboardController::class, 'index'] )->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group([
    'prefix' => 'admin', 
    // 'namespace' => 'admin',
    'middleware' => 'auth'
    ], function()
    {
        Route::resources([
            'category' => CategoryController::class,
            'attribute' => AttributeController::class,
            'attributeset' => AttributesetController::class,
        ]);
    });

require __DIR__.'/auth.php';
