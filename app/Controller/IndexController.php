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

class IndexController extends BaseController
{
    public function index()
    {

        Anime::get();

    }

    public function banner(): \Psr\Http\Message\ResponseInterface
    {

        $data =  Banner::select("id","image","title")->get();
        return $this->success("获取成功",$data);
    }

    public function videoList(): \Psr\Http\Message\ResponseInterface
    {
        $series = AnimeSeries::all();
        $animeData = RelAnimeSeries::seriesList();
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
