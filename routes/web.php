<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TicketController;
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
Route::match(['POST','GET'],'/login', [LoginController::class, 'login'])
    ->name('login');
Route::match(['POST','GET'],'/register_post', [LoginController::class, 'register'])
    ->name('register_post');
Route::get('/destroy', [LoginController::class, 'destroy'])
    ->name('destroy');

Route::match(['POST','GET'],'/post_conbinaison', [FrontController::class, 'postConbinaison'])
    ->name('postConbinaison');
Route::match(['POST','GET'],'/post_game', [FrontController::class, 'postGame'])
    ->name('postGame');
Route::get('/', [FrontController::class, 'home'])
    ->name('home');
Route::get('/fixture_lost_home', [FrontController::class, 'fixture_lost'])
    ->name('fixture_lost');
Route::get('/fixture_lost_away', [FrontController::class, 'fixture__away_lost'])
    ->name('fixture_lost_away');
Route::get('/fixture_not_lost', [FrontController::class, 'lastFixture_defeats'])
    ->name('lastFixture_defeats');
Route::get('/detail_fixture/{id}', [FrontController::class, 'detail_fixture'])
    ->name('detail_fixture');
Route::get('/over5_5', [FrontController::class, 'over5_5'])
    ->name('over5_5');
Route::get('/over6_5', [FrontController::class, 'over6_5'])
    ->name('over6_5');
Route::get('/over7_5', [FrontController::class, 'over7_5'])
    ->name('over7_5');
Route::get('/over8_5', [FrontController::class, 'over8_5'])
    ->name('over8_5');
Route::get('/exactscore', [FrontController::class, 'exactscore'])
    ->name('exactscore');
Route::get('/game/{id}', [FrontController::class, 'game'])
    ->name('game');
Route::get('/resultat/{id}', [FrontController::class, 'resultat'])
    ->name('resultat');
Route::get('/getfixture/', [FrontController::class, 'getFixture'])
    ->name('getfixture');
Route::get('/calculPrice', [PaymentController::class, 'calculPrice'])
    ->name('calculPrice');
Route::get('/proof', [PaymentController::class, 'upload_proof'])
    ->name('upload_proof');
Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])
        ->name('dashboard');
    Route::get('my-game', [DashboardController::class, 'myGame'])
        ->name('mygame');
    Route::get('bonus', [DashboardController::class, 'bonus'])
        ->name('bonus');
    Route::get('withdraw', [DashboardController::class, 'withdraw'])
        ->name('withdraw');
    Route::get('transaction', [DashboardController::class, 'transaction'])
        ->name('transaction');
    Route::get('settings', [DashboardController::class, 'settings'])
        ->name('settings');
    Route::match(['POST','GET'],'/deposit', [DashboardController::class, 'deposit'])
        ->name('deposit');
});


Route::get('logout', [LoginController::class, 'destroy'])
    ->name('logout');
Route::get('/register', [FrontController::class, 'register'])
    ->name('nextregister');
Route::get('/sign_in', [FrontController::class, 'login'])
    ->name('sign_in');
Route::match(['POST','GET'],'/register_ajax', [FrontController::class, 'register_ajax'])->name('register_ajax');
Route::match(['POST','GET'],'/login_ajax', [FrontController::class, 'login_next'])->name('login_next');
Route::match(['POST','GET'],'/get_balance', [FrontController::class, 'getBalance'])->name('get_balance');
Route::match(['POST','GET'],'/check_register', [FrontController::class, 'check_register'])->name('check_register');
Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware' => ['auth','isAdmin']], function () {
    Route::match(["POST", "GET"], '/lotto_fixture_list', [BackendController::class, 'lotto_fixture_list'])
        ->name('lotto_fixture_list');
    Route::match(["POST", "GET"], '/partipates', [BackendController::class, 'partipates'])
        ->name('partipates');
    Route::match(["POST", "GET"], '/result/{id}', [BackendController::class, 'result'])
        ->name('result');
    Route::match(["POST", "GET"], '/winner_detail/{id}', [BackendController::class, 'winner_detail'])
        ->name('winner_detail');
    Route::match(["POST", "GET"], '/payment/{id}', [BackendController::class, 'payment'])
        ->name('payment');
    Route::get('configuration', [BackendController::class, 'configuration'])
        ->name('configuration');
    Route::get('transaction', [BackendController::class, 'transaction'])
        ->name('transaction');
    Route::match(["POST", "GET"],'transaction/{id}', [BackendController::class, 'transaction_detail'])
        ->name('transaction_detail');
    Route::match(["POST", "GET"], '/post_payment', [BackendController::class, 'postPayment'])
        ->name('post_payment');
});
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::match(["POST", "GET"], '/ticket', [TicketController::class, 'tikets'])
        ->name('tikets');
    Route::match(["POST", "GET"], '/ticket/{id}', [TicketController::class, 'updatetikets'])
        ->name('updatetikets');
});
Route::match(["POST", "GET"], '/payment', [PaymentController::class, 'init'])
    ->name('init_payment');
Route::match(["POST", "GET"], '/payment-finish', [PaymentController::class, 'finish'])
    ->name('finish_payment');
Route::match(["POST", "GET"], '/stripe_echec', [PaymentController::class, 'stripe_echec'])
    ->name('stripe_echec');
Route::match(["POST", "GET"], '/stripe_success', [PaymentController::class, 'stripe_success'])
    ->name('stripe_success');
