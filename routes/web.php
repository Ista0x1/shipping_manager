<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ AdminController,InvoicesController,
     TaxesController, CustomersController,TransactionController,ReceiveController,ShippingOutController,
     ShippingMethodController,ShippingController,InvoiceDetailsController,OutController,EnterController,RoleController ,
    InvoiceAttachmentsController , ShippingAttachmentsController , EmployeesController, EmployeeAttachmentsController,CustomerAttachmentsController,BalanceController,UserController};
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

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Auth::routes(['register' => false]);

Route::middleware(['admin'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resources([
        'invoices' => InvoicesController::class,
        'taxes' => TaxesController::class,

        'methods' => ShippingMethodController::class,
        'shippings' => ShippingController::class,
        'invoicedetails' => InvoiceDetailsController::class,
        'invoiceAttachments' => InvoiceAttachmentsController::class,
        'shippingattachments' => ShippingAttachmentsController::class,
        'employees' => EmployeesController::class,
        'customerattachments' => CustomerAttachmentsController::class,
        'employeeAttachments' => EmployeeAttachmentsController::class,
        'enter' => EnterController::class,
        'out' => OutController::class,
        'balance' => BalanceController::class,
        'shippingout' => ShippingOutController::class,
        'user' => UserController::class,
        'roles' => RoleController::class,
    ]);
    Route::get('createcustomer' ,[UserController::class , 'createcustomer'])->name('customer_account');
    Route::get('view_file/{id}/{file_name}',[InvoiceDetailsController::class ,'open_file']);
    Route::get('download/{id}/{file_name}',[InvoiceDetailsController::class ,'get_file']);
    Route::get('Print_invoice/{id}',[InvoicesController::class,'Print_invoice']);
    Route::get('print_shipping/{id}',[ShippingController::class,'Print_invoice']);
    Route::get('shipping/{id}' ,[ShippingController::class , 'gettaxes']);
    Route::get('customer/{id}' ,[CustomersController::class , 'getcustomer']);
    Route::get('gettrans/{id}',[OutController::class,'gettrans']);
    //Route::get('getremaining/{id}',[TransactionController::class,'getremaining']);
    Route::get('getremaining/{customerId}',[OutController::class,'getremaining'] );
    Route::get('getproducts/{customerId}',[ShippingOutController::class,'getproducts'] );
    // Route::get('send',[TransactionController::class,'send']);
    Route::get('notcomplet',[InvoicesController::class,'notcomplet'])->name('notcomplet');
    Route::get('notpaid',[InvoicesController::class,'notpaid'])->name('notpaid');
    Route::get('paid',[InvoicesController::class,'paid'])->name('paid');
    Route::get('customertrans',[EnterController::class,'customertrans'])->name('customertrans');
    Route::get('Status_show/{id}',[InvoicesController::class,'Status_show'])->name('Status_show');
    Route::post('Status_update',[InvoicesController::class,'Status_update'])->name('Status_update');
    Route::get('Status_shipping/{id}',[ShippingController::class,'Status_show'])->name('Status_shipping');
    Route::post('Status_shipping_update',[ShippingController::class,'Status_update'])->name('Status_shipping_update');

});
//Route::get('customer/customerdetails/{id}' , [CustomersController::class ,'show'])->name('customer.show');
Route::resource('customers' , CustomersController::class);

Route::get('/{page}', [AdminController::class, 'index']);
