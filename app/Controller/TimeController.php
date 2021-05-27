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
use App\Model\Banner;
use App\Model\RelAnimeSeries;

class TimeController extends AbstractController
{

    public function timeList(): \Psr\Http\Message\ResponseInterface
    {
        $where = [
            ['weekdayShow', '=', 1],
        ] ;
        $data = Anime::timeList($where);
        $res = [];
        $weekDayArray = [
            "周一",
            "周二",
            "周三",
            "周四",
            "周五",
            "周六",
            "周日"];
        foreach ($data as $key=>$value){
            foreach ($weekDayArray as $weekdayKey=>$weekday){
                if ($value["weekday"]==$weekdayKey+1){
                    $res[$weekdayKey]["name"] = $weekday;
                    $res[$weekdayKey]["list"][] = $value;
                }
            }
        }
        return $this->success("获取成功",$res);
    }



}
