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
use App\Controller\ClassifyController;
use App\Controller\TimeController;
use App\Controller\AnimeController;
use App\Controller\TaskController;
use App\Middleware\Auth\JwtMiddleware;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');

Router::get('/favicon.ico', function () {
    return '';
});

Router::post('/login', [AuthController::class, 'login']);
Router::post('/register', [AuthController::class, 'register']);
Router::post('/list', [AuthController::class, 'list']);
Router::get('/captcha', [AuthController::class, 'captcha']);//获取验证码


Router::get('/test', [AuthController::class, 'test']);//获取验证码

Router::post('/home/banner', [IndexController::class, 'banner']);
Router::post('/home/videoList', [IndexController::class, 'videoList']);


Router::post('/classify/getTag', [ClassifyController::class, 'getTag']);


Router::post('/time/getTimeList', [TimeController::class, 'timeList']);

Router::post('/anime/info', [AnimeController::class, 'info']);


Router::get('/task/info', [TaskController::class, 'info']);



//// 该 Group 下的所有路由都将应用配置的中间件
//Router::addGroup('/v2', function () {

//}, ['middleware' => [\App\Middleware\Auth\JwtMiddleware::class]]
//);