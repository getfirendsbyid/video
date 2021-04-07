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
use App\Request\Auth\LoginRequest;
use http\Client\Request;
use Hyperf\HttpServer\Contract\RequestInterface;
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
        
        if ($username && $password) {
            //这里应为没有做auth的登录认证系统，为了展示随便写点数据
            $userData = [
                'uid' => 1,
                'username' => 'xx',
            ];
            //获取Token
            $token = (string)$jwt->getToken($userData);
            //返回响应的json数据
            return $this->response->json(['code' => 0, 'msg' => '获取token成功', 'data' => ['token' => $token]]);
        }
        return $this->response->json(['code' => 0, 'msg' => '登录失败', 'data' => []]);
    }

    # http头部必须携带token才能访问的路由
    public function getData(): ResponseInterface
    {
        return $this->response->json(['code' => 0, 'msg' => 'success', 'data' => ['a' => 1]]);
    }
}
