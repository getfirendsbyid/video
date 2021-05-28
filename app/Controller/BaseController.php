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

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Container\ContainerInterface;

abstract class BaseController
{
    /**
     * @Inject
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @Inject
     * @var RequestInterface
     */
    protected $request;

    /**
     * @Inject
     * @var ResponseInterface
     */
    protected $response;

    public  function error(int $code,string $msg,$data=[]): \Psr\Http\Message\ResponseInterface
    {
        $json = [
            'code'=>$code,
            'msg'=>$msg,
            'data'=>$data
        ];
        return $this->response->json($json);
    }

    public  function success(string $msg,$data=[]): \Psr\Http\Message\ResponseInterface
    {
        $json = [
            'code'=>200,
            'msg'=>$msg,
            'data'=>$data
        ];
        return $this->response->json($json);
    }
}
