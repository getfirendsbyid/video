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
namespace App\Controller;
use App\Logic\AuthLogic;
use App\Model\VUser;
use App\Request\Auth\LoginRequest;
use http\Client\Request;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Redis\Redis;
use Hyperf\Utils\ApplicationContext;
use Phper666\JWTAuth\JWT;
use Psr\Http\Message\ResponseInterface;
use Psr\SimpleCache\InvalidArgumentException;


class AuthController extends AbstractController
{
    # 模拟登录,获取token
    /**
     * @param JWT $jwt
     * @param LoginRequest $request
     * @return ResponseInterface
     * @throws InvalidArgumentException
     */
    public function login(JWT $jwt,LoginRequest $request): ResponseInterface
    {
        $username = $this->request->input('username');
        $password = $this->request->input('password');
        $password = $this->request->input('code');
        //处理登录逻辑
        $authRes = AuthLogic::Login($username,$password);
        //生成jwt token
        $token = $jwt->getToken($authRes);
        $container = ApplicationContext::getContainer();
        $redis = $container->get(Redis::class);
        //reids存储凭证
        $redis->set('v_user:'.$username,$token);
        $redis->set($token,$authRes);
        $data = ["token"=>$token];
        return $this->success('登录成功', $data);
    }

    public function register()
    {

    }

    # http头部必须携带token才能访问的路由
    public function getData(): ResponseInterface
    {
        return $this->response->json(['code' => 0, 'msg' => 'success', 'data' => ['a' => 1]]);
    }
}
