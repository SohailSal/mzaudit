<?php

use App\Http\Controllers\AdviserAccountController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\YearController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\AdvisorController;
use App\Http\Controllers\BankBranchController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\BankBalanceController;
use App\Http\Controllers\BankConfirmationController;
use App\Http\Controllers\AdviserConfirmationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;


use Illuminate\Support\Facades\Auth;

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


// use Illuminate\Http\Request;

// Route::get('/user/invoice/{invoice}', function (Request $request, $invoiceId) {
//     return $request->user()->downloadInvoice($invoiceId, [
//         'vendor' => 'Your Company',
//         'product' => 'Your Product',
//     ]);
// });

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->name('dashboard');

Route::get('users/create', [UserController::class, 'create'])
    ->name('users.create')
    ->middleware('auth');


Route::post('users', [UserController::class, 'store'])
    ->name('users.store')
    ->middleware('auth');


Route::get('companies', [CompanyController::class, 'index'])
    ->name('companies')
    ->middleware('auth');


Route::get('companies/create', [CompanyController::class, 'create'])
    ->name('companies.create')
    ->middleware('auth');

Route::get('companies/{company}', [CompanyController::class, 'show'])
    ->name('companies.show')
    ->middleware('auth');

Route::post('companies', [CompanyController::class, 'store'])
    ->name('companies.store')
    ->middleware('auth');

Route::get('companies/{company}/edit', [CompanyController::class, 'edit'])
    ->name('companies.edit')
    ->middleware('auth');

Route::put('companies/{company}', [CompanyController::class, 'update'])
    ->name('companies.update')
    ->middleware('auth');

Route::delete('companies/{company}', [CompanyController::class, 'destroy'])
    ->name('companies.destroy')
    ->middleware('auth');

Route::get('indexy', [CompanyController::class, 'indexy']);

Route::get('companies/coch/{id}', [CompanyController::class, 'coch'])
    ->name('companies.coch');

Route::get('companies/yrch/{id}', [CompanyController::class, 'yrch'])
    ->name('companies.yrch');

Route::get('company-pdf/{fiscal}', [CompanyController::class, 'companypdf'])
->name('companypdf')
->middleware('auth');

Route::get('get_banks', [CompanyController::class, 'getBanks']);
Route::get('get_branches/{bank}', [CompanyController::class, 'getBranches'])
    ->name('braches')
    ->middleware('auth');


Route::get('pd', [CompanyController::class, 'pd'])
    ->name('pd')
    ->middleware('auth');
Route::get('ex', [CompanyController::class, 'ex'])
    ->name('ex')
    ->middleware('auth');

Route::get('word', [CompanyController::class, 'word'])
    ->name('word')
    ->middleware('auth');





//Dashboad

Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

    Route::get('dashboard/{value}', [DashboardController::class, 'dashboard_ilter'])
    ->name('dashboard.filter')
    ->middleware('auth');



// Adviosr

Route::get('advisors', [AdvisorController::class, 'index'])
    ->name('advisors')
    ->middleware('auth');


Route::get('advisors/create', [AdvisorController::class, 'create'])
    ->name('advisors.create')
    ->middleware('auth');

Route::get('advisors/{advisor}', [AdvisorController::class, 'show'])
    ->name('advisors.show')
    ->middleware('auth');

Route::post('advisors', [AdvisorController::class, 'store'])
    ->name('advisors.store')
    ->middleware('auth');

Route::get('advisors/{advisor}/edit', [AdvisorController::class, 'edit'])
    ->name('advisors.edit')
    ->middleware('auth');

Route::put('advisors/{advisor}', [AdvisorController::class, 'update'])
    ->name('advisors.update')
    ->middleware('auth');

Route::delete('advisors/{advisor}', [AdvisorController::class, 'destroy'])
    ->name('advisors.destroy')
    ->middleware('auth');

//AdviserAccount

Route::get('advisor_accounts', [AdviserAccountController::class, 'index'])
    ->name('advisor_accounts')
    ->middleware('auth');

Route::get('advisor_accounts/create', [AdviserAccountController::class, 'create'])
    ->name('advisor_accounts.create')
    ->middleware('auth');

// Route::get('advisor_accounts/{account}', [AdviserAccountController::class, 'show'])
//     ->name('accounts.show')
//     ->middleware('auth');

Route::post('advisor_accounts', [AdviserAccountController::class, 'store'])
    ->name('advisor_accounts.store')
    ->middleware('auth');

Route::get('advisor_account/edit', [AdviserAccountController::class, 'edit'])
    ->name('advisor_account.edit')
    ->middleware('auth');

Route::put('advisor_accounts/{account}', [AdviserAccountController::class, 'update'])
    ->name('advisor_accounts.update')
    ->middleware('auth');

Route::delete('advisor_accounts/{adviserAccount}', [AdviserAccountController::class, 'destroy'])
    ->name('advisor_accounts.destroy')
    ->middleware('auth');

// Banks

Route::get('banks', [BankController::class, 'index'])
    ->name('banks')
    ->middleware('auth');

// Route::get('banks/create', [BankController::class, 'create'])
//     ->name('banks.create')
//     ->middleware('auth');

Route::get('banks/{accounts}/create', [BankController::class, 'create'])
    ->name('banks.create')
    ->middleware('auth');

Route::get('banks/{bank}', [BankController::class, 'show'])
    ->name('banks.show')
    ->middleware('auth');

Route::post('banks', [BankController::class, 'store'])
    ->name('banks.store')
    ->middleware('auth');

Route::get('banks/{bank}/edit', [BankController::class, 'edit'])
    ->name('banks.edit')
    ->middleware('auth');

Route::put('banks/{bank}', [BankController::class, 'update'])
    ->name('banks.update')
    ->middleware('auth');

Route::delete('banks/{bank}', [BankController::class, 'destroy'])
    ->name('banks.destroy')
    ->middleware('auth');

// Bank Branches

Route::get('branches', [BankBranchController::class, 'index'])
    ->name('branches')
    ->middleware('auth');

Route::get('branches/{accounts}create', [BankBranchController::class, 'create'])
    ->name('branches.create')
    ->middleware('auth');

Route::get('branches/branchchange/{id}', [BankBranchController::class, 'branchchange'])
    ->name('branches.branchchange');

Route::get('branches/{branch}', [BankBranchController::class, 'show'])
    ->name('branches.show')
    ->middleware('auth');

Route::post('branches', [BankBranchController::class, 'store'])
    ->name('branches.store')
    ->middleware('auth');

Route::get('branches/{branch}/edit', [BankBranchController::class, 'edit'])
    ->name('branches.edit')
    ->middleware('auth');

Route::put('branches/{branch}', [BankBranchController::class, 'update'])
    ->name('branches.update')
    ->middleware('auth');

Route::delete('branches/{branch}', [BankBranchController::class, 'destroy'])
    ->name('branches.destroy')
    ->middleware('auth');


// Bank Accounts

Route::get('accounts', [BankAccountController::class, 'index'])
    ->name('accounts')
    ->middleware('auth');

Route::get('accounts/create', [BankAccountController::class, 'create'])
    ->name('accounts.create')
    ->middleware('auth');

Route::get('accounts/{account}', [BankAccountController::class, 'show'])
    ->name('accounts.show')
    ->middleware('auth');

Route::post('accounts', [BankAccountController::class, 'store'])
    ->name('accounts.store')
    ->middleware('auth');

Route::get('account/edit', [BankAccountController::class, 'edit'])
    ->name('account.edit')
    ->middleware('auth');

Route::put('accounts/{account}', [BankAccountController::class, 'update'])
    ->name('accounts.update')
    ->middleware('auth');

Route::delete('accounts/{account}', [BankAccountController::class, 'destroy'])
    ->name('accounts.destroy')
    ->middleware('auth');

// Bank Balances

Route::get('balances', [BankBalanceController::class, 'index'])
    ->name('balances')
    ->middleware('auth');

Route::get('balances/create', [BankBalanceController::class, 'create'])
    ->name('balances.create')
    ->middleware('auth');

Route::get('balances/{balance}', [BankBalanceController::class, 'show'])
    ->name('balances.show')
    ->middleware('auth');

Route::post('balances', [BankBalanceController::class, 'store'])
    ->name('balances.store')
    ->middleware('auth');

Route::get('bal/edit', [BankBalanceController::class, 'edity'])
    ->name('bal.edit')
    ->middleware('auth');



Route::put('balances/{balance?}', [BankBalanceController::class, 'update'])
    ->name('balances.update')
    ->middleware('auth');

Route::delete('balances/{balance}', [BankBalanceController::class, 'destroy'])
    ->name('balances.destroy')
    ->middleware('auth');

// Bank confirmations

Route::get('confirmations', [BankConfirmationController::class, 'index'])
    ->name('confirmations')
    ->middleware('auth');

Route::get('confirmations/create', [BankConfirmationController::class, 'create'])
    ->name('confirmations.create')
    ->middleware('auth');

Route::get('confirmations/{confirmation}', [BankConfirmationController::class, 'show'])
    ->name('confirmations.show')
    ->middleware('auth');

Route::post('confirmations', [BankConfirmationController::class, 'store'])
    ->name('confirmations.store')
    ->middleware('auth');


Route::get('confirmation/edit', [BankConfirmationController::class, 'edit'])
    ->name('confirmations.edit')
    ->middleware('auth');

Route::put('balances_updated/{id}', [BankConfirmationController::class, 'updated'])
->name('balances.updated')
->middleware('auth');

Route::put('confirmations/{balance}', [BankConfirmationController::class, 'update'])
    ->name('confirmations.update')
    ->middleware('auth');

Route::delete('confirmations/{confirmation}', [BankConfirmationController::class, 'destroy'])
    ->name('confirmations.destroy')
    ->middleware('auth');

Route::get('bankConfig', [BankConfirmationController::class, 'bankConfig'])
->name('bankConfig')
->middleware('auth');

Route::get('bankconfirmUpload/{id}', [BankConfirmationController::class, 'bankconfirmUpload'])
->name('bankconfirmUpload')
->middleware('auth');

Route::get('branchespdf', [BankConfirmationController::class, 'branchespdf'])
->name('branchespdf')
->middleware('auth');



// Advisor confirmations

Route::get('advisor_confirmations', [AdviserConfirmationController::class, 'index'])
    ->name('advisor_confirmations')
    ->middleware('auth');

Route::get('advisor_confirmations/create', [AdviserConfirmationController::class, 'create'])
    ->name('advisor_confirmations.create')
    ->middleware('auth');

Route::get('advisor_confirmations/{advisor_confirmation}', [AdviserConfirmationController::class, 'show'])
    ->name('advisor_confirmations.show')
    ->middleware('auth');

Route::post('advisor_confirmations', [AdviserConfirmationController::class, 'store'])
    ->name('advisor_confirmations.store')
    ->middleware('auth');


Route::get('advisor_confirmationsP/edit', [AdviserConfirmationController::class, 'edit'])
    ->name('advisor_confirmations.edit')
    ->middleware('auth');

Route::put('advisor_updated/{id}', [AdviserConfirmationController::class, 'advisorupload'])
->name('advisor.updated')
->middleware('auth');

Route::get('advisorconfirmUpload/{id}', [AdviserConfirmationController::class, 'advisorconfirmUpload'])
->name('advisorconfirmUpload')
->middleware('auth');

Route::put('advisor_confirmations/{advisor_confirmation}', [AdviserConfirmationController::class, 'update'])
    ->name('advisor_confirmations.update')
    ->middleware('auth');

Route::delete('advisor_confirmations/{advisor_confirmation}', [AdviserConfirmationController::class, 'destroy'])
    ->name('advisor_confirmations.destroy')
    ->middleware('auth');

Route::get('advisor_word', [AdviserConfirmationController::class, 'advisor_word'])
->name('advisor_word')
->middleware('auth');

Route::get('advisorspdf', [AdviserConfirmationController::class, 'advisorspdf'])
->name('advisorspdf')
->middleware('auth');

// Route::get('bankConfig', [AdviserConfirmationController::class, 'bankConfig'])
// ->name('bankConfig')
// ->middleware('auth');

// Route::get('branchespdf', [AdviserConfirmationController::class, 'branchespdf'])
// ->name('branchespdf')
// ->middleware('auth');

// Years

Route::get('years', [YearController::class, 'index'])
    ->name('years')
    ->middleware('auth');

Route::get('years/create', [YearController::class, 'create'])
    ->name('years.create')
    ->middleware('auth');

Route::get('years/{year}', [YearController::class, 'show'])
    ->name('years.show')
    ->middleware('auth');

Route::post('years', [YearController::class, 'store'])
    ->name('years.store')
    ->middleware('auth');

Route::get('years/{year}/edit', [YearController::class, 'edit'])
    ->name('years.edit')
    ->middleware('auth');

Route::put('years/{year}', [YearController::class, 'update'])
    ->name('years.update')
    ->middleware('auth');

Route::delete('years/{year}', [YearController::class, 'destroy'])
    ->name('years.destroy')
    ->middleware('auth');
