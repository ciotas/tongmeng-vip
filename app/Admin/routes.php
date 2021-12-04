<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->resource('/', 'HomeController');
    // 价格提醒
    $router->resource('reminders', 'ReminderController');
    // 市场标的
    $router->resource('exchanges', 'ExchangeController');
    
    // api
    // 获取市场
    $router->get('/api/exchanges', 'ApiController@exchanges');

});
