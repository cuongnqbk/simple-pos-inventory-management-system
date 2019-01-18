<?php

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
    return view('welcome');
});


Auth::routes();


Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function(){

	Route::get('logout', '\Auth\LoginController@logout');

	Route::get('home', [
		'uses' => 'HomeController@index',
		'as' => 'home'
	]);
	
	/*Ajax*/
	Route::get('/clientsAjax', [
		'uses' => 'AjaxController@clientsAjax',
		'as' => 'clientsAjax'
	]);
	Route::post('/clientsPostAjax', [
		'uses' => 'AjaxController@clientsAjax',
		'as' => 'clientsPostAjax'
	]);
	Route::get('/suppliersAjax', [
		'uses' => 'AjaxController@suppliersAjax',
		'as' => 'suppliersAjax'
	]);
	Route::post('/suppliersPostAjax', [
		'uses' => 'AjaxController@suppliersAjax',
		'as' => 'suppliersPostAjax'
	]);
	// Route::get('/productsAjax', [
	// 	'uses' => 'AjaxController@productsAjax',
	// 	'as' => 'productsAjax'
	// ]);
	// Route::post('/productsPostAjax', [
	// 	'uses' => 'AjaxController@productsAjax',
	// 	'as' => 'productsPostAjax'
	// ]);
	Route::get('/productsShopsAjax', [
		'uses' => 'AjaxController@productsShopsAjax',
		'as' => 'productsShopsAjax'
	]);
	Route::post('/productsShopsPostAjax', [
		'uses' => 'AjaxController@productsShopsAjax',
		'as' => 'productsShopsPostAjax'
	]);
	// Route::post('/productsPostAjax', [
	// 	'uses' => 'AjaxController@productsBarcodeAjax',
	// 	'as' => 'productsPostAjax'
	// ]);
	Route::post('/allProductsAjax', [
		'uses' => 'AjaxController@allProductsAjax',
		'as' => 'allProductsAjax'
	]);

	/* Users  */
	Route::get('/users', [
		'uses' => 'UsersController@index',
		'as' => 'users'
	]);
	Route::get('/user/create', [
		'uses' => 'UsersController@create',
		'as' => 'user.create'
	]);
	Route::post('/user/store', [
		'uses' => 'UsersController@store',
		'as' => 'user.store'
	]);
	Route::get('/user/show/{id}', [
		'uses' => 'UsersController@show',
		'as' => 'user.show'
	]);
	Route::post('/user/update/{id}', [
		'uses' => 'UsersController@update',
		'as' => 'user.update'
	]);
	Route::get('/user/delete/{id}', [
		'uses' => 'UsersController@destroy',
		'as' => 'user.delete'
	]);
	Route::get('/user/makeAdmin/{id}', [
		'uses' => 'UsersController@makeAdmin',
		'as' => 'user.makeAdmin'
	]);
	Route::get('/user/removeAdmin/{id}', [
		'uses' => 'UsersController@removeAdmin',
		'as' => 'user.removeAdmin'
	]);

	/*Clients*/

	Route::get('/clients', [
		'uses' => 'ClientsController@index',
		'as' => 'clients'
	]);
	Route::get('/client/create', [
		'uses' => 'ClientsController@create',
		'as' => 'client.create'
	]);
	Route::post('/client/store', [
		'uses' => 'ClientsController@store',
		'as' => 'client.store'
	]);
	Route::get('/client/show/{id}', [
		'uses' => 'ClientsController@show',
		'as' => 'client.show'
	]);
	Route::post('/client/update/{id}', [
		'uses' => 'ClientsController@update',
		'as' => 'client.update'
	]);

	/*Debit Nots*/

	Route::get('/debitNotes', [
		'uses' => 'DebitNotesController@index',
		'as' => 'debitNotes'
	]);
	Route::get('/debitNote/create', [
		'uses' => 'DebitNotesController@create',
		'as' => 'debitNote.create'
	]);
	Route::post('/debitNote/store', [
		'uses' => 'DebitNotesController@store',
		'as' => 'debitNote.store'
	]);
	Route::get('/debitNote/show/{id}', [
		'uses' => 'DebitNotesController@show',
		'as' => 'debitNote.show'
	]);
	Route::post('/debitNote/update/{id}', [
		'uses' => 'DebitNotesController@update',
		'as' => 'debitNote.update'
	]);

	/* Product Type */
	Route::get('/productTypes', [
		'uses' => 'ProductTypesController@index',
		'as' => 'productTypes'
	]);
	Route::get('/productType/create', [
		'uses' => 'ProductTypesController@create',
		'as' => 'productType.create'
	]);
	Route::post('/productType/store', [
		'uses' => 'ProductTypesController@store',
		'as' => 'productType.store'
	]);
	Route::get('/productType/show/{id}', [
		'uses' => 'ProductTypesController@show',
		'as' => 'productType.show'
	]);
	Route::post('/productType/update/{id}', [
		'uses' => 'ProductTypesController@update',
		'as' => 'productType.update'
	]);

	/* Product */
	Route::get('/showInventory', [
		'uses' => 'ProductsController@index',
		'as' => 'showInventory'
	]);
	Route::get('/product/create', [
		'uses' => 'ProductsController@create',
		'as' => 'product.create'
	]);
	Route::post('/product/store', [
		'uses' => 'ProductsController@store',
		'as' => 'product.store'
	]);
	Route::get('/product/show/{id}', [
		'uses' => 'ProductsController@show',
		'as' => 'product.show'
	]);
	Route::post('/product/update/{id}', [
		'uses' => 'ProductsController@update',
		'as' => 'product.update'
	]);
	Route::get('/product/transfer', [
		'uses' => 'ProductsController@transfer',
		'as' => 'product.transfer'
	]);
	Route::post('/product/storeTransfer', [
		'uses' => 'ProductsController@storeTransfer',
		'as' => 'product.storeTransfer'
	]);
	// Route::post('/productsPostAjax', [
	// 	'uses' => 'SalesController@productsBarcodeAjax',
	// 	'as' => 'productsPostAjax'
	// ]);

	/* Shop */
	Route::get('/shops', [
		'uses' => 'ShopsController@index',
		'as' => 'shops'
	]);
	Route::get('/shop/create', [
		'uses' => 'ShopsController@create',
		'as' => 'shop.create'
	]);
	Route::post('/shop/store', [
		'uses' => 'ShopsController@store',
		'as' => 'shop.store'
	]);
	Route::get('/shop/show/{id}', [
		'uses' => 'ShopsController@show',
		'as' => 'shop.show'
	]);
	Route::post('/shop/update/{id}', [
		'uses' => 'ShopsController@update',
		'as' => 'shop.update'
	]);

	/* Sale */
	Route::get('/destroyCart', [
		'uses' => 'SalesController@destroyCart',
		'as' => 'destroyCart'
	]);
	Route::get('/addInvoice', [
		'uses' => 'SalesController@index',
		'as' => 'addInvoice'
	]);
	Route::post('/cart/addToCart', [
		'uses' => 'SalesController@addToCart',
		'as' => 'cart.addToCart'
	]);

	Route::post('/cart/cartStore', [
		'uses' => 'SalesController@cartStore',
		'as' => 'cart.cartStore'
	]);
	Route::get('/printInvoice', [
		'uses' => 'SalesController@cartStore',
		'as' => 'printInvoice'
	]);
	Route::post('/cart/removeItem/{id}', [
		'uses' => 'SalesController@removeItem',
		'as' => 'cart.removeItem'
	]);
	Route::post('/cart/increment/{id}', [
		'uses' => 'SalesController@increment',
		'as' => 'cart.increment'
	]);
	Route::post('/cart/decrement/{id}', [
		'uses' => 'SalesController@decrement',
		'as' => 'cart.decrement'
	]);
	Route::post('/cart/changeQuantity/{id}', [
		'uses' => 'SalesController@changeQuantity',
		'as' => 'cart.changeQuantity'
	]);


	/*Stock*/
	Route::get('/stock/create', [
		'uses' => 'StocksController@create',
		'as' => 'stock.create'
	]);
	Route::post('/stock/store', [
		'uses' => 'StocksController@store',
		'as' => 'stock.store'
	]);

	/* Expense */
	Route::get('/expenses', [
		'uses' => 'ExpensesController@index',
		'as' => 'expenses'
	]);
	Route::post('/expenses/', [
		'uses' => 'ExpensesController@expenseBetweenDate',
		'as' => 'expenses'
	]);
	Route::get('/expense/create', [
		'uses' => 'ExpensesController@create',
		'as' => 'expense.create'
	]);
	Route::post('/expense/store', [
		'uses' => 'ExpensesController@store',
		'as' => 'expense.store'
	]);
	Route::get('/expense/show/{id}', [
		'uses' => 'ExpensesController@show',
		'as' => 'expense.show'
	]);
	Route::post('/expense/update/{id}', [
		'uses' => 'ExpensesController@update',
		'as' => 'expense.update'
	]);

	/* Expense Fields */
	Route::get('/expenseFields', [
		'uses' => 'ExpenseFieldsController@index',
		'as' => 'expenseFields'
	]);
	Route::get('/expenseField/create', [
		'uses' => 'ExpenseFieldsController@create',
		'as' => 'expenseField.create'
	]);
	Route::post('/expenseField/store', [
		'uses' => 'ExpenseFieldsController@store',
		'as' => 'expenseField.store'
	]);
	Route::get('/expenseField/show/{id}', [
		'uses' => 'ExpenseFieldsController@show',
		'as' => 'expenseField.show'
	]);
	Route::post('/expenseField/update/{id}', [
		'uses' => 'ExpenseFieldsController@update',
		'as' => 'expenseField.update'
	]);

	/* Received Payment */
	Route::get('/receivePayments', [
		'uses' => 'ReceivePaymentsController@index',
		'as' => 'receivePayments'
	]);
	Route::post('/receivePayments/', [
		'uses' => 'ReceivePaymentsController@receiveBetweenDate',
		'as' => 'receivePayments'
	]);
	Route::get('/receivePayment/create', [
		'uses' => 'ReceivePaymentsController@create',
		'as' => 'receivePayment.create'
	]);
	Route::post('/receivePayment/store', [
		'uses' => 'ReceivePaymentsController@store',
		'as' => 'receivePayment.store'
	]);
	Route::get('/receivePayment/show/{id}', [
		'uses' => 'ReceivePaymentsController@show',
		'as' => 'receivePayment.show'
	]);
	Route::post('/receivePayment/update/{id}', [
		'uses' => 'ReceivePaymentsController@update',
		'as' => 'receivePayment.update'
	]);

	/* Manager */
	Route::get('/managers', [
		'uses' => 'Auth\ManagersController@index',
		'as' => 'managers'
	]);
	Route::get('/manager/cretae', [
		'uses' => 'Auth\ManagersController@create',
		'as' => 'manager.create'
	]);
	Route::post('/manager/store', [
		'uses' => 'Auth\ManagersController@store',
		'as' => 'manager.store'
	]);
	Route::get('/manager/show/{id}', [
		'uses' => 'Auth\ManagersController@show',
		'as' => 'manager.show'
	]);
	Route::post('/manager/update/{id}', [
		'uses' => 'Auth\ManagersController@update',
		'as' => 'manager.update'
	]);
	Route::get('/manager/delete/{id}', [
		'uses' => 'Auth\ManagersController@destroy',
		'as' => 'manager.delete'
	]);

	/*Profile*/
	Route::get('profile', [
		'uses' => 'ProfilesController@profile',
		'as' => 'profile'
	]);
	Route::post('profile/update', [
		'uses' => 'ProfilesController@profileUpdate',
		'as' => 'profile.update'
	]);

	/*Reports*/
	Route::get('/productEntryReport', [
		'uses' => 'ReportsController@productEntryReport',
		'as' => 'productEntryReport'	
	]);
	Route::post('/productEntryReport', [
		'uses' => 'ReportsController@productEntryReportDateBetween',
		'as' => 'productEntryReport'	
	]);
	Route::get('/salesReport', [
		'uses' => 'ReportsController@salesReport',
		'as' => 'salesReport'	
	]);
	Route::post('/salesReport', [
		'uses' => 'ReportsController@salesReportBetweenDate',
		'as' => 'salesReport'	
	]);
	Route::get('/viewSale/{id}', [
		'uses' => 'ReportsController@viewSale',
		'as' => 'viewSale'	
	]);

	Route::get('/returnReport', [
		'uses' => 'ReportsController@returnReport',
		'as' => 'returnReport'	
	]);
	Route::post('/returnReport', [
		'uses' => 'ReportsController@returnReportBetweenDate',
		'as' => 'returnReport'	
	]);	
	Route::get('/viewReturn/{id}', [
		'uses' => 'ReportsController@viewReturn',
		'as' => 'viewReturn'
	]);

	Route::get('/financialInsight', [
		'uses' => 'ReportsController@financialInsight',
		'as' => 'financialInsight'	
	]);
	Route::post('/financialInsight', [
		'uses' => 'ReportsController@financialInsightBetweenDate',
		'as' => 'financialInsight'	
	]);

	/* Barcode */

	Route::get('/barcode/create', [
		'uses' => 'BarcodesController@create',
		'as' => 'barcode.create'
	]);
	Route::post('/barcode/store', [
		'uses' => 'BarcodesController@store',
		'as' => 'barcode.store'
	]);
	Route::post('/barcode/printBarcode', [
		'uses' => 'BarcodesController@printBarcode',
		'as' => 'barcode.printBarcode'
	]);
	Route::get('/barcode/destroyPrintBarcode', [
		'uses' => 'BarcodesController@destroyPrintBarcode',
		'as' => 'barcode.destroyPrintBarcode'
	]);

	/*Suppliers*/

	Route::get('/suppliers', [
		'uses' => 'SuppliersController@index',
		'as' => 'suppliers'
	]);
	Route::get('/supplier/create', [
		'uses' => 'SuppliersController@create',
		'as' => 'supplier.create'
	]);
	Route::post('/supplier/store', [
		'uses' => 'SuppliersController@store',
		'as' => 'supplier.store'
	]);
	Route::get('/supplier/show/{id}', [
		'uses' => 'SuppliersController@show',
		'as' => 'supplier.show'
	]);
	Route::post('/supplier/update/{id}', [
		'uses' => 'SuppliersController@update',
		'as' => 'supplier.update'
	]);
	Route::get('/supplier/allSupplierExpenses', [
		'uses' => 'SuppliersController@allSupplierExpenses',
		'as' => 'supplier.allSupplierExpenses'
	]);	
	Route::post('/supplier/allSupplierExpenses', [
		'uses' => 'SuppliersController@allSupplierExpensesBetweenDate',
		'as' => 'supplier.allSupplierExpenses'
	]);
	Route::get('/supplier/supplierExpense', [
		'uses' => 'SuppliersController@supplierExpense',
		'as' => 'supplier.supplierExpense'
	]);
	Route::post('/supplier/storeSupplierExpense', [
		'uses' => 'SuppliersController@storeSupplierExpense',
		'as' => 'supplier.storeSupplierExpense'
	]);
	Route::get('/supplier/allSupplierBills', [
		'uses' => 'SuppliersController@allSupplierBills',
		'as' => 'supplier.allSupplierBills'
	]);
	Route::post('/supplier/allSupplierBills', [
		'uses' => 'SuppliersController@allSupplierBillsBetweenDate',
		'as' => 'supplier.allSupplierBills'
	]);
	Route::get('/supplier/supplierBill', [
		'uses' => 'SuppliersController@supplierBill',
		'as' => 'supplier.supplierBill'
	]);
	Route::post('/supplier/storeSupplierBill', [
		'uses' => 'SuppliersController@storeSupplierBill',
		'as' => 'supplier.storeSupplierBill'
	]);

	/*Cash In Out*/

	Route::get('/cashInOuts', [
		'uses' => 'CashInOutController@index',
		'as' => 'cashInOuts'
	]);
	Route::get('/cashInOut/create', [
		'uses' => 'CashInOutController@create',
		'as' => 'cashInOut.create'
	]);
	Route::post('/cashInOut/store', [
		'uses' => 'CashInOutController@store',
		'as' => 'cashInOut.store'
	]);
	Route::get('/cashInOut/show/{id}', [
		'uses' => 'CashInOutController@show',
		'as' => 'cashInOut.show'
	]);

	/* Return */
	Route::get('/return', [
		'uses' => 'ReturnsController@create',
		'as' => 'return'
	]);
	Route::post('/return/addReturn', [
		'uses' => 'ReturnsController@addReturn',
		'as' => 'return.addReturn'
	]);
	Route::post('/return/addSale', [
		'uses' => 'ReturnsController@addSale',
		'as' => 'return.addSale'
	]);
	Route::get('/destroyReturn', [
		'uses' => 'ReturnsController@destroyReturn',
		'as' => 'destroyReturn'
	]);
	Route::get('/destroySale', [
		'uses' => 'ReturnsController@destroySale',
		'as' => 'destroySale'
	]);

	Route::post('/return/removeItemReturn/{id}', [
		'uses' => 'ReturnsController@removeItemReturn',
		'as' => 'return.removeItemReturn'
	]);
	Route::post('/return/removeItemSale/{id}', [
		'uses' => 'ReturnsController@removeItemSale',
		'as' => 'return.removeItemSale'
	]);

	Route::post('/return/changeReturnProductQuantity/{id}', [
		'uses' => 'ReturnsController@changeReturnProductQuantity',
		'as' => 'return.changeReturnProductQuantity'
	]);
	Route::post('/return/changeSaleQuantity/{id}', [
		'uses' => 'ReturnsController@changeSaleQuantity',
		'as' => 'return.changeSaleQuantity'
	]);

	Route::post('/return/returnSaleStore', [
		'uses' => 'ReturnsController@returnSaleStore',
		'as' => 'return.returnSaleStore'
	]);
});
