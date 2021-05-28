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
use App\Model\AnimeSeries;
use App\Model\AnimeTag;
use App\Model\Banner;
use App\Model\RelAnimeSeries;
use App\Model\RelAnimeTag;
use Yurun\Util\HttpRequest;

class TaskController extends BaseController
{

    public function info()
    {
        $anime = Anime::select("aId","id")->get()->toArray();
        $http = HttpRequest::newSession();
        foreach ($anime as $key=>$value){
            echo "当前aid=>".$value["aId"];

            $response = $http->get('https://api.agefans.app/v2/detail/'.$value['aId']);
            $content = $response->body(); // 网页源码
            $body = json_decode($content,true);
            $tagArr = $body["AniInfo"]["R剧情类型2"];
            foreach ($tagArr as $tagkey=>$tagValue){
               $tagData = AnimeTag::firstOrCreate(["tag"=>$tagValue],["tag"=>$tagValue,"createdAt"=>date("Y-m-d",time()),
                   "updatedAt"=>date("Y-m-d",time())]);
               $tagwhere = ["tag_id"=>$tagData['id'],"anime_id"=>$value["id"]];
               $tagsave = [
                   "tag_id"=>$tagData['id'],
                   "anime_id"=>$value["id"],
                   "createdAt"=>date("Y-m-d",time()),
                   "updatedAt"=>date("Y-m-d",time())
               ];
                RelAnimeTag::firstOrCreate($tagwhere,$tagsave);
            }


        }

    }

    public function getOrderIndex(){

    }


}
