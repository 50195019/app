<?php

use App\Http\Controllers\ProductResisterController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ArriveController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResisterController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArriveCreateController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\UsersController;










/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset/{token}', 'Auth\ResetPasswordController@reset');


Route::get('/', function () {
    return view('home');
});



//ユーザーによってログイン後のリダイレクト先を変更

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/employee/resister', [EmployeeController::class, 'store'])->name('employee.register');

//商品登録リソース
Route::resource('/productresister', 'ProductResisterController');//リソース

//社員登録リソース
Route::resource('/employee', 'EmployeeController');//リソース

//入荷予定商品登録リソース
Route::resource('/arrive', 'ArriveCreateController');//リソース



//商品新規登録画面へ
Route::get('/create_product', [ProductResisterController::class, 'create'])->name('create.product');
//商品の登録
Route::post('/create_product', [ProductResisterController::class, 'store'])->name('create.product');

// //一般社員新規登録画面表示
Route::get('/create_employee', [EmployeeController::class, 'create'])->name('create.employee');
//入荷予定商品情報一覧表示
Route::get('/arrive_page', [ArriveController::class, 'arrivePage'])->name('arrive.page');
//入荷予定商品の登録画面へ
Route::get('/create_arrive', [ArriveCreateController::class, 'create'])->name('create.arrive');
Route::post('/create_arrive', [ArriveCreateController::class, 'store'])->name('create.arrive');

//入荷商品の確定
Route::post('/confirm_arrive', [ArriveController::class, 'confirm'])->name('confirm');

//在庫商品情報一覧表示
Route::get('/stock_page', [StockController::class, 'stockPage'])->name('stock.page');

Route::get('/delete_stock/{id}', [StockController::class, 'delete'])->name('delete.stock');

//ajax通信用のルート作成
Route::post('/stock/more', [StockController::class, 'ajaxStock']);



// });