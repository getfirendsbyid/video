<?php
namespace App\Logic;
use App\Model\VUser;
use Hyperf\Redis\Redis;
use Hyperf\Utils\ApplicationContext;
use Phper666\JWTAuth\JWT;
use function PHPUnit\Framework\throwException;

class AuthLogic {
    /**
     * @param string $username
     * @param string $password
     * @param JWT $jwt
     * @return array|\Hyperf\Database\Model\Builder|\Hyperf\Database\Model\Model|object
     */
    public static function Login(string $username, string $password)
    {
        $hashPassword = password_hash($password,PASSWORD_ARGON2I);
        $where = ['username' => $username];
        $select = ['username','email','status','avatar','phone'];
        $user = VUser::where($where)->select($select)->first();
        if (empty($user)){
            throw new \LogicException("用户名不存在");
        }
        if (!password_verify($password,$hashPassword)){
            throw new \LogicException("用户名或者密码不正确");
        }
        if ($user->status==2){
            throw new \LogicException("账号已冻结");
        }
        return $user->toArray();
    }
}