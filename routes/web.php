<?php

use App\Http\Controllers\DashboardUpcomingController;
use App\Http\Controllers\GembaController;
use App\Http\Controllers\NameController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ActionListController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;

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
    return view('auth.login');
})->name('login');

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::get('/password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    // Dashboard Routes
    Route::get('/dashboard', [DashboardUpcomingController::class, 'index'])->name('dashboard.index');
    Route::get('/', [DashboardUpcomingController::class, 'index'])->name('welcome');
    Route::get('/fetch-gemba-data', [DashboardUpcomingController::class, 'fetchGembaData']);
    Route::get('/generate-gemba-report', [GembaController::class, 'generateGembaReport']);

    // Action List Routes
    Route::get('/actionLists', [ActionListController::class, 'index'])->name('actions.index');
    Route::get('/actionLists/{actionList}', [ActionListController::class, 'show'])->name('actions.show');

    Route::middleware(['role:manager|admin'])->group(function () {
        Route::get('/actionLists/{actionList}/edit', [ActionListController::class, 'edit'])->name('actions.edit');
        Route::put('/actionLists/{actionList}', [ActionListController::class, 'update'])->name('actions.update');
    });
    Route::put('actions/{actionList}/updateComment', [ActionListController::class, 'updateComment'])->name('actions.updateComment');
    Route::get('actions/{actionList}/editComment', [ActionListController::class, 'editComment'])->name('actions.editComment');
    Route::middleware(['role:manager|admin', 'can:delete,actionList'])->group(function () {
        Route::delete('/actionLists/{actionList}', [ActionListController::class, 'destroy'])->name('actions.delete');
    });
    Route::post('/actionLists', [ActionListController::class, 'store'])->name('actions.store');
    Route::get('gembas/{gemba}/actionLists/create', [ActionListController::class, 'create'])->name('actions.create');

    // Gemba Routes
    Route::get('/gembas', [GembaController::class, 'index'])->name('gembas.index');
    Route::post('/gembas', [GembaController::class, 'store'])->name('gembas.store');
    Route::get('/gembas/create', [GembaController::class, 'create'])->name('gembas.create');
    Route::get('/gembas/{gemba}', [GembaController::class, 'show'])->name('gembas.show');
    Route::delete('/gembas/{gemba}', [GembaController::class, 'destroy'])->name('gembas.destroy');
    Route::get('gembas/{gemba}/edit', [GembaController::class, 'edit'])->middleware('role:manager|admin')->name('gembas.edit');
    Route::patch('gembas/{gemba}', [GembaController::class, 'update'])->middleware('role:manager|admin')->name('gembas.update');
    Route::get('/gembas/create-with-date/{date}', [ScheduleController::class, 'createWithDate'])->name('gembas.create-with-date');
    Route::get('gembas/{gemba}/names/create', [NameController::class, 'create'])->name('names.create');
    Route::post('gembas/{gemba}/names', [NameController::class, 'store'])->name('names.store');

    // Schedule Routes
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
    Route::get('/schedules/create', [ScheduleController::class, 'create'])->name('schedules.create');
    Route::get('/schedules/{schedule}', [ScheduleController::class, 'show'])->name('schedules.show');
    Route::put('/schedules/{schedule}', [ScheduleController::class, 'update'])->name('schedules.update');
    Route::delete('/schedules/{schedule}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');
    Route::get('/schedules/{schedule}/edit', [ScheduleController::class, 'edit'])->name('schedules.edit');

    // Home Route
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Export/Import Routes
    Route::get('/export', [ActionListController::class, 'exportExcel'])->name('export');
    Route::get('download-template', [ActionListController::class, 'downloadTemplate'])->name('download.template');
    Route::get('export-all', [ActionListController::class, 'exportExcel'])->name('export.all');
    Route::post('import', [ActionListController::class, 'importExcel'])->name('import');

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware('role:admin')->name('admin.dashboard');
    Route::patch('/admin/dashboard/update-roles', [AdminController::class, 'updateRoles'])->middleware('role:admin')->name('admin.updateRoles');
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->middleware('role:admin')->name('admin.deleteUser');
    Route::post('/admin/change-role/{user}', [AdminController::class, 'changeRole'])->middleware('role:admin')->name('admin.changeRole');

    Route::get('/manager/dashboard', [ManagerController::class, 'index'])->middleware('role:manager')->name('manager.dashboard');
    Route::patch('/manager/gemba/{gemba}/update', [ManagerController::class, 'updateGembaManager'])->middleware('role:manager')->name('manager.gemba.update');
    Route::get('/manager/gemba/{gemba}/actions', [ManagerController::class, 'showGembaActions'])->middleware('role:manager')->name('manager.gemba.actions');
});
