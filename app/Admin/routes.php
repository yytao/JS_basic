<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('magazine', MagazineController::class);

    $router->resource('article', ArticleController::class);

    $router->resource('data', DataController::class);

    //图片上传接口
    $router->post('upload', "ArticleController@imageUpload");

});
