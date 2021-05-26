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
use App\Request\Auth\RegisterRequest;
use http\Client;
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
        $username = $this->request->input('username');
        $password = $this->request->input('password');
        $repassword = $this->request->input('repassword');
//        $code = $this->request->input('code');
//        $codeKey = $this->request->input('codekey');
//        // 验证
//        $captchaFactory = ApplicationContext::getContainer()->get(CaptchaFactory::class);
//        $codeValidator = $captchaFactory->validate($codeKey, $code);
//        if (!$codeValidator){
//            return $this->error(400,"验证码输入错误");
//        }
        if ($repassword!=$password){
            return $this->error(400,"两次密码不一致");
        }
        //验证是否已经被注册
        $count = VUser::where(['username'=>$username])->count();
        if ($count>0){
            return $this->error(400,"该用户名已经被使用");
        }
        $data = [
            "username"=>$username,
            "password"=>password_hash($password,PASSWORD_ARGON2I),
            "status"=>1,
            "createdAt"=>date("Y-m-d H:i:s"),
            "updatedAt"=>date("Y-m-d H:i:s"),
            "avatar"=>"/img/avatar.jpg",
        ];
        VUser::insert($data);
        return $this->success("注册成功！");
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


    public function test(){
        $statr = time();
        $url = "https://www.uviewui.com/components/swiper.html";
        $client = new \GuzzleHttp\Client();
        for ($i=0;$i<500;$i++){
            $res = $client->request("get",$url);
            echo $i;
        }
        echo "结束".(time()-$statr);
    }

}
