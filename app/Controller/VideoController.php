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
use Hyperf\Redis\Redis;
use Hyperf\Utils\ApplicationContext;
use HyperfExt\Captcha\CaptchaFactory;
use Phper666\JWTAuth\JWT;
use Psr\Http\Message\ResponseInterface;
use Psr\SimpleCache\InvalidArgumentException;


class VideoController extends AbstractController
{
    
}
