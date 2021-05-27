<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;
use App\Controller\AuthController;
use App\Controller\IndexController;
use App\Middleware\Auth\JwtMiddleware;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');

Router::get('/favicon.ico', function () {
    return '';
});
Router::post('/login', [AuthController::class, 'login']);
Router::post('/register', [AuthController::class, 'register']);
Router::post('/list', [AuthController::class, 'list']);
Router::get('/captcha', [AuthController::class, 'captcha']);//获取验证码

<<<<<<< HEAD
Router::get('/test', [AuthController::class, 'test']);//获取验证码
=======
Router::get('/test', [IndexController::class, 'index']);


>>>>>>> 6f1b2a718c28f8f808b1a87d8c3fbb9021fccf3a

//// 该 Group 下的所有路由都将应用配置的中间件
//Router::addGroup('/v2', function () {

//}, ['middleware' => [\App\Middleware\Auth\JwtMiddleware::class]]
//);