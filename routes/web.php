<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Middleware\Admin;

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

Route::get('/', [FrontEndController::class, 'index']);
Route::get('/shop', [FrontEndController::class, 'shop']);
Route::get('/category-details/{url}', [FrontEndController::class, 'category_details']);
Route::get('/category-details/{url}', [FrontEndController::class, 'category_details'])->name('category-details');

Route::get('/product-deatils/{url}', [FrontEndController::class, 'product_details'])->name('product.details');
Route::get('/cart-item-remove/{id}', [cartController::class, 'remove_cart_product'])->name('cart-item-remove');

Route::any('/update-cart', [cartController::class, 'update_cart']);

Route::any('/cart-add-product', [cartController::class, 'cart_add_product'])->name('cart_add_product');

Route::get('/coustomer-checkout', [CheckoutController::class, 'coustomer_checkout_form'])->name('coustomer.checkout.form');

Route::post('shipping-info-save', [CheckoutController::class, 'shipping_info_save'])->name('shipping.info.save');

Route::post('/customer-register', [CheckoutController::class, 'customer_register'])->name('customer.register');
Route::get('/checkout-shipping', [CheckoutController::class, 'checkout_shipping_form']);
Route::get('/make-payment', [CheckoutController::class, 'make_payment']);

Route::post('/new-order', [CheckoutController::class, 'new_order'])->name('new.order');

Route::get('/logout-customer', [CheckoutController::class, 'logout_customer'])->name('customer.logout');
Route::post('/login-customer', [CustomerController::class, 'login_customer'])->name('customer.login');

Auth::routes();

Route::middleware([Admin::class])->group(function () {
	
	Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::get('/add-category', [CategoryController::class, 'create'])->name('add.category');
    Route::post('/insert-category', [CategoryController::class, 'store']);
	Route::get('/manage-category', [CategoryController::class, 'index'])->name('index.category');
	Route::get('/change-category-status/{id}', [CategoryController::class, 'change_status'])->name('change.category.status');
	Route::get('/edit-category/{id}', [CategoryController::class, 'edit_category'])->name('edit.category');
	Route::post('/update-category/{id}', [CategoryController::class, 'update']);
	Route::get('/delete-category/{id}', [CategoryController::class, 'delete'])->name('delete.category');


	Route::get('/add-product', [ProductController::class, 'create'])->name('add.product');
	Route::get('/product-category', [ProductController::class, 'index'])->name('index.product');
	Route::post('/insert-product', [ProductController::class, 'store']);
	Route::get('/change-product-status/{id}', [ProductController::class, 'change_status'])->name('change.product.status');
	Route::get('/edit-product/{id}', [ProductController::class, 'edit_product'])->name('edit.product');
	Route::get('/delete-product/{id}', [ProductController::class, 'delete'])->name('delete.product');
	Route::post('/update-product/{id}', [ProductController::class, 'update']);

	Route::get('/order-manage', [OrderController::class, 'order_manage_view'])->name('manage.order');
	Route::get('/order-detail/{id}', [OrderController::class, 'order_details'])->name('order.details');
	Route::get('/order-invoice/{id}', [OrderController::class, 'order_invoice_view'])->name('order.invoice.view');
	Route::get('/order-invoice-download/{id}', [OrderController::class, 'order_invoice_download'])->name('order.invoice.download');

});


 