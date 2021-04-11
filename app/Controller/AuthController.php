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
use App\Request\Auth\LoginRequest;
use App\Request\Auth\RegisterRequest;
use Hyperf\Redis\Redis;
use Hyperf\Utils\ApplicationContext;
use HyperfExt\Captcha\CaptchaFactory;
use Phper666\JWTAuth\JWT;
use Psr\Http\Message\ResponseInterface;
use Psr\SimpleCache\InvalidArgumentException;


class AuthController extends AbstractController
{

//    private  $captchaFactory;
//    public function __construct()
//    {
//        $this->captchaFactory = ApplicationContext::getContainer()->get(CaptchaFactory::class);
//    }

    # 模拟登录,获取token
    /**
     * @param JWT $jwt
     * @param LoginRequest $request
     * @return ResponseInterface
     * @throws InvalidArgumentException
     */
    public function login(JWT $jwt,LoginRequest $request): ResponseInterface
    {
        $captchaFactory = ApplicationContext::getContainer()->get(CaptchaFactory::class);
        $username = $this->request->input('username');
        $password = $this->request->input('password');
        $code = $this->request->input('code');
        $codeKey = $this->request->input('codekey');
        // 验证

        $codeValidator = $captchaFactory->validate($codeKey, $code);
        if (!$codeValidator){
            return $this->error(400,"验证码输入错误");
        }
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

    public function register(RegisterRequest $request)
    {

    }

    /**
     * @return ResponseInterface
     * 获取验证码
     */
    public function captcha(): ResponseInterface
    {
        $captchaFactory = ApplicationContext::getContainer()->get(CaptchaFactory::class);
        $captcha = $captchaFactory->create();
        $response = [
            'key' => $captcha->getKey(),
            'blob' => $captcha->getBlob()->toDataUrl(),
            'ttl' => $captcha->getTtl(),
        ];
        return $this->success("验证码获取成功",$response);
    }

    # http头部必须携带token才能访问的路由
    public function getData(): ResponseInterface
    {
        return $this->response->json(['code' => 0, 'msg' => 'success', 'data' => ['a' => 1]]);
    }
}
