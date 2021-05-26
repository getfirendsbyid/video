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

use App\Model\AnimeSeries;
use App\Model\Banner;
use App\Model\RelAnimeSeries;
use App\Spider\Downloader\FiveDM\Anime;

class IndexController extends AbstractController
{
    public function index()
    {
        Anime::get();
//        $this->success("1");
    }

    public function banner(): \Psr\Http\Message\ResponseInterface
    {

        $data =  Banner::select("id","image","title")->get();
        return $this->success("获取成功",$data);
    }

    public function videoList(): \Psr\Http\Message\ResponseInterface
    {
        $series = AnimeSeries::all();
        $animeData = RelAnimeSeries::leftJoin("anime","rel_anime_series.animeId","anime.id")
            ->leftJoin("anime_series","rel_anime_series.seriesId","anime_series.id")
            ->select('anime.id','anime.name as title','anime.coverSmallImg as src',"rel_anime_series.seriesId")
            ->get();
        $data = [];
        foreach ($series as $seriesKey=>$seriesValue){
            foreach ($animeData as $animeValue)
                if ($seriesValue["id"]==$animeValue["seriesId"]){
                    $data[$seriesKey]["series"]=$seriesValue["series"];
                    $data[$seriesKey]["data"][]=$animeValue;
                }
        }
        return $this->success("请求成功",$data);
    }


}
