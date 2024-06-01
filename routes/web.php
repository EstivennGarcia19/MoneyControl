<?php

use App\Http\Controllers\ChestsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\IncomesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoguinController;
use Illuminate\Support\Facades\Route;

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
})->name('welcome');

Route::get('register/index', [LoginController::class, 'index_register'])->name('login.index_register');
Route::get('login/index', [LoginController::class, 'index_login'])->name('login.index_login');
Route::post('register/', [LoginController::class, 'register'])->name('login.register');
Route::post('login/', [LoginController::class, 'login'])->name('login.login');
Route::get('logout/', [LoginController::class, 'logout'])->name('login.logout');



Route::controller(ExpensesController::class)->group(function () {

    Route::get('home/', 'index')->middleware('auth')->name('home.index');
    Route::post('expenses/', 'store')->middleware('auth')->name('expenses.store');
    Route::get('show/', 'show')->middleware('auth')->name('show.show');
});

Route::post('incomes/', [IncomesController::class, 'store'])->middleware('auth')->name('incomes.store');

Route::controller(ChestsController::class)->group(function () {

    Route::get('chests/', 'index')->middleware('auth')->name('chests.index');
    Route::post('xd/', 'store')->middleware('auth')->name('chests.store');
    Route::get('chest/{id}/edit', 'show')->middleware('auth')->name('chest.show');
    Route::put('chest/{info_chest}/add', 'add_amount')->middleware('auth')->name('chest.add_amount');
    Route::put('chest/{info_chest}/remove', 'remove_amount')->middleware('auth')->name('chest.remove_amount');
    Route::delete('chest/deleteChest/{chest}', 'destroy')->middleware('auth')->name('chests.destroy');    
    Route::post('chest/{chest}/changeColor/{color}', 'changeColor')->name('chest.changeColor');

});

Route::controller(HistoryController::class)->group(function () {

    Route::get('history/', 'index')->middleware('auth')->name('histoty.index');
    Route::get('history/incomes', 'incomes')->middleware('auth')->name('histoty.incomes');
    Route::get('history/months/{month}/{date}', 'daysExpenses')->middleware('auth')->name('history.daysExpenses');
    Route::get('history/day/{day}', 'detailDay')->middleware('auth')->name('history.detailDay');
    Route::put('history/newAmount/', 'store')->middleware('auth')->name('history.store');
    Route::get('history/addForgottenDay/', 'forgottenDay')->middleware('auth')->name('history.forgottenDay');
    Route::post('history/addForgottenDay/', 'addforgottenDay')->middleware('auth')->name('history.addforgottenDay');
}); 


Route::controller(UserController::class)->group(function () {
   
    Route::get('profile/see/{id}', 'show')->middleware('auth')->name('profile.show');
    Route::get('profile/edit/{user}', 'edit')->middleware('auth')->name('profile.edit');
    Route::put('profile/update/{user}', 'update')->middleware('auth')->name('profile.update');    
    Route::delete('profile/byebye/{user}', 'destroy')->name('user.destroy');
});


