<?php

use App\Http\Controllers\Web\Auth\PasswordUpdateConreoller;
use App\Http\Controllers\Web\Backend\BarcodeGeneratorController;
use App\Http\Controllers\Web\Backend\BatchController;
use App\Http\Controllers\Web\Backend\CompanyController;
use App\Http\Controllers\Web\Backend\CurrencySettingController;
use App\Http\Controllers\Web\Backend\CustomerController;
use App\Http\Controllers\Web\Backend\CategorieController;
use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Backend\MilkController;
use App\Http\Controllers\Web\Backend\MilkPurchaseController;
use App\Http\Controllers\Web\Backend\MilkStorageController;
use App\Http\Controllers\Web\Backend\PaymentController;
use App\Http\Controllers\Web\Backend\ProductController;
use App\Http\Controllers\Web\Backend\PurchaseReportController;
use App\Http\Controllers\Web\Backend\RiderController;
use App\Http\Controllers\Web\Backend\SellController;
use App\Http\Controllers\Web\Backend\SellReportController;
use App\Http\Controllers\Web\Backend\StockController;
use App\Http\Controllers\Web\Backend\StockReportController;
use App\Http\Controllers\Web\Backend\SupplierController;
use App\Http\Controllers\Web\Backend\TransactionController;
use App\Http\Controllers\Web\Backend\TransactionPaymentController;
use App\Http\Controllers\Web\Backend\UnitSettingController;
use App\Http\Controllers\Web\Backend\UserController;
use App\Http\Controllers\Web\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace' => 'App\Http\Controllers\Web\Backend',
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => ['auth']
        // 'middleware' => ['auth', 'roles:admin,staff']
    ],
    function () {

        Route::get('barcode', [BarcodeGeneratorController::class, "generate"])->name('barcode');

        Route::resource('batches', BatchController::class);
        Route::get('batches/delete/{batch}', [BatchController::class, 'delete'])->name('batches.delete');

        Route::get('batches-search-product', [BatchController::class, 'search_product'])->name('batches.search_product');
        Route::get('batches-add-product', [BatchController::class, 'add_product'])->name('batches.add_product');

        Route::resource('companys', CompanyController::class)->except(['create', 'store', 'show', 'edit', 'delete', 'destroy']);

        Route::resource('categories', CategorieController::class);
        Route::get('categories/delete/{category}', [CategorieController::class, 'delete'])->name('categories.delete');

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('currencies', CurrencySettingController::class);
        Route::get('currencies/delete/{currency}', [CurrencySettingController::class, 'delete'])->name('currencies.delete');

        Route::resource('customers', CustomerController::class);
        Route::get('customers/delete/{customer}', [CustomerController::class, 'delete'])->name('customers.delete');
        Route::get('customers-export', [CustomerController::class,'exportExcel'])->name('customer.export');

        Route::resource('milks', MilkController::class);
        Route::get('milks/delete/{milk}', [MilkController::class, 'delete'])->name('milks.delete');

        Route::resource('milk-purchases', MilkPurchaseController::class);
        Route::get('milk-purchase/delete/{milk_purchase}', [MilkPurchaseController::class, 'delete'])->name('milk-purchases.delete');
        Route::get('milk-purchase/invoice/{milk_purchase}', [MilkPurchaseController::class, 'downloadMilkPurchaseInvoice'])->name('milk-purchases.invoice');
        Route::get('milk-purchase/get_milk_product', [MilkPurchaseController::class, 'get_milk_product'])->name('milk-purchase.get_milk_product');
        Route::get('milk-purchase/search_milk_product', [MilkPurchaseController::class, 'search_milk_product'])->name('milk-purchase.search_milk_product');

        Route::get('milk-purchase/report', [PurchaseReportController::class, 'index'])->name('purchase-report.index');

        Route::get('milk-storage', [MilkStorageController::class, 'index'])->name('milk-storage.index');

        Route::resource('products', ProductController::class);
        Route::get('products/delete/{product}', [ProductController::class, 'delete'])->name('products.delete');

        // Route::resource('payment',PaymentController::class);
        // Route::get('payment/invoice/{payment}',[PaymentController::class,'downloadPaymentInvoice'])->name('payment.invoice');
    
        Route::resource('riders', RiderController::class);
        Route::get('riders/delete/{rider}', [RiderController::class, 'delete'])->name('riders.delete');

        Route::resource('sells', SellController::class);
        Route::get('sells/delete/{sell}', [SellController::class, 'delete'])->name('sells.delete');
        Route::get('sells-stocks-search', [SellController::class, 'search_stock'])->name('sells.stocks_search');
        Route::get('sells-stocks-get', [SellController::class, 'get_stock'])->name('sells.stocks_get');

        Route::get('sale-report', [SellReportController::class, 'index'])->name('sell-report.index');
        Route::get('sale-report/download', [SellReportController::class, 'downloadSellReport'])->name('sell-report.export');

        Route::resource('suppliers', SupplierController::class);
        Route::get('suppliers/delete/{supplier}', [SupplierController::class, 'delete'])->name('suppliers.delete');

        Route::get('stocks', [StockController::class, 'index'])->name('stocks.index');
        Route::get('stocks/report', [StockReportController::class, 'index'])->name('stocks.report');


        Route::get('transaction/delete/{transaction}', [TransactionController::class, "delete"])->name('transaction.delete');
        Route::get('transaction/print/{transaction}', [TransactionController::class, "print"])->name('transaction.print');
        Route::resource('transaction', TransactionController::class);

        Route::get('transaction-payment', [TransactionPaymentController::class, 'index'])->name('transaction-payment.index');
        Route::get('transaction-payment/{transaction}/create', [TransactionPaymentController::class, 'create'])->name('transaction-payment.create');
        Route::post('transaction-payment/{transaction}/create', [TransactionPaymentController::class, 'store'])->name('transaction-payment.store');
        Route::get('transaction-payment/{transaction_payment}/edit', [TransactionPaymentController::class, 'edit'])->name('transaction-payment.edit');
        Route::put('transaction-payment/{transaction_payment}/edit', [TransactionPaymentController::class, 'update'])->name('transaction-payment.update');
        // Route::get('transaction-payment/{transaction_payment}/delete', [TransactionPaymentController::class, 'delete'])->name('transaction-payment.delete');
        // Route::delete('transaction-payment/{transaction_payment}/delete', [TransactionPaymentController::class, 'destroy'])->name('transaction-payment.destroy');



        Route::resource('units', UnitSettingController::class);
        Route::get('units/delete/{unit}', [UnitSettingController::class, 'delete'])->name('units.delete');

        Route::resource('users', UserController::class);
        Route::get('users/delete/{user}', [UserController::class, 'delete'])->name('users.delete');

        Route::get('profile', [ProfileController::class, 'show'])->name('profile');
        Route::get('profile-edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile-edit', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('update-password', [PasswordUpdateConreoller::class, 'update'])->name('password.update');


    }
)

    ?>