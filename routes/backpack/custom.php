<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('user', 'UserCrudController');
    Route::crud('tag', 'TagCrudController');
    Route::crud('setting', 'SettingCrudController');
    Route::crud('servicecategory', 'ServicecategoryCrudController');
    Route::crud('service', 'ServiceCrudController');
    Route::crud('order', 'OrderCrudController');
    Route::crud('projectcategory', 'ProjectcategoryCrudController');
    Route::crud('project', 'ProjectCrudController');
    Route::crud('client', 'ClientCrudController');
    Route::crud('blogcategory', 'BlogcategoryCrudController');
    Route::crud('post', 'PostCrudController');
    Route::crud('employee', 'EmployeeCrudController');
    Route::crud('shipping', 'ShippingCrudController');
    Route::crud('productcategory', 'ProductcategoryCrudController');
    Route::crud('product', 'ProductCrudController');
    Route::crud('productorder', 'ProductorderCrudController');
    Route::crud('event', 'EventCrudController');
}); // this should be the absolute last line of this file