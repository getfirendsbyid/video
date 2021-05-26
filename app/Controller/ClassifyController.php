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

use App\Model\AnimeArea;
use App\Model\AnimeLetter;
use App\Model\AnimeSeason;
use App\Model\AnimeSeries;
use App\Model\AnimeTag;
use App\Model\AnimeType;
use App\Model\AnimeYear;
use App\Model\Banner;
use App\Model\RelAnimeSeries;
use App\Spider\Downloader\FiveDM\Anime;

class ClassifyController extends AbstractController
{

    public function getTag(): \Psr\Http\Message\ResponseInterface
    {
        $area = AnimeArea::select("id","area as name")->get();
        $letter = AnimeLetter::select("id","letter as name")->get();
        $season = AnimeSeason::select("id","season as name")->get();
        $tag = AnimeTag::select("id","tag as name")->get();
        $type = AnimeType::select("id","type as name")->get();
        $year = AnimeYear::select("id","year as name")->get();
        $data[0]["name"]="地区";
        $data[0]["data"]=$area;
        $data[1]["name"]="季度";
        $data[1]["data"]=$season;
        $data[2]["name"]="类型";
        $data[2]["data"]=$type;
        $data[3]["name"]="首字母";
        $data[3]["data"]=$letter;
        $data[4]["name"]="标签";
        $data[4]["data"]=$tag;
        $data[5]["name"]="年份";
        $data[5]["data"]=$year;
        return $this->success("获取成功",$data);
    }

    public function getVideoList(){

    }



}
