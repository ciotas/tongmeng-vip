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
    // 个人中心
    $router->resource('admin_users', 'AdminUserController');
    // 订阅
    $router->resource('podcasts', 'PodcastController');
    // 订阅用户
    $router->resource('subscribers', 'SubscriberController');
    // 持仓
    $router->resource('barns', 'BarnController');
    // 要闻Feeds
    $router->get('feeds', 'HomeController@getFeeds');

    // api
    // 获取市场
    $router->get('/api/exchanges', 'ApiController@exchanges');
    // 获取价格
    $router->get('/api/price', 'ApiController@latestPrice');

});
