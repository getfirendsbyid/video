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




use App\Model\Anime;
use Hyperf\HttpServer\Contract\RequestInterface;

class AnimeController extends BaseController
{
    public function info(RequestInterface  $request){
        $id = $request->input("id");
        $res = Anime::getOne($id);
        return $this->success("请求成功",$res);
    }
}
