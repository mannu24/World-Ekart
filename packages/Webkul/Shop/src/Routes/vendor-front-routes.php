<?php

use Illuminate\Support\Facades\Route;
use Webkul\CMS\Http\Controllers\Shop\PagePresenterController;
use Webkul\Shop\Http\Controllers\HomeController;
use Webkul\Shop\Http\Controllers\ProductController;
use Webkul\Shop\Http\Controllers\ReviewController;
use Webkul\Shop\Http\Controllers\SearchController;
use Webkul\Shop\Http\Controllers\SubscriptionController;
use Webkul\Shop\Http\Controllers\VendorController;

Route::group(['middleware' => ['web', 'locale', 'theme', 'currency']], function () {
    /**
     * Cart merger middleware. This middleware will take care of the items
     * which are deactivated at the time of buy now functionality. If somehow
     * user redirects without completing the checkout then this will merge
     * full cart.
     *
     * If some routes are not able to merge the cart, then place the route in this
     * group.
     */
    Route::group(['middleware' => ['cart.merger']], function () {
        /**
         * CMS pages.
         */
        Route::get('page/{slug}', [PagePresenterController::class, 'presenter'])->name('shop.cms.page');

        /**
         * Fallback route.
         */
        Route::fallback(\Webkul\Shop\Http\Controllers\ProductsCategoriesProxyController::class . '@index')
            ->defaults('_config', [
                'product_view'  => 'shop::products.view',
                'category_view' => 'shop::products.index',
            ])
            ->name('shop.productOrCategory.index');
    });

    Route::get('/seller-registration', [VendorController::class, 'index'])->defaults('_config', [
        'view' => 'shop::vendor.index',
    ])->name('shop.seller.register');

    Route::post('/store_seller', [VendorController::class, 'save'])->defaults('_config', [
        'view' => 'shop::vendor.save',
    ])->name('shop.vendor.save');

    // Route::get('/stores', [VendorController::class, 'stores'])->defaults('_config', [
    //     'view' => 'shop::vendor.stores',
    // ])->name('shop.vendor.stores');



    Route::get('/store/{name}', [VendorController::class, 'view_store'])->defaults('_config', [
        'view' => 'shop::vendor.store-page',
    ])->name('shop.vendor.store-page');
});
