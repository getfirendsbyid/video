<?php
namespace App\Spider\Downloader\FiveDM;

use Yurun\Util\HttpRequest;
use \Yurun\Util\YurunHttp\Co\Batch;
use Hyperf\Utils\Coroutine;
use function PHPUnit\Framework\throwException;

class Anime {

    public static function get(){

        $starttime = date("Y-m-d H:i:s");
        echo "startTime".$starttime.PHP_EOL;

        for ($i=0;$i<3810;$i++){
            $urls[$i] = (new HttpRequest)->url("http://www.milimili.cc/anime/".$i);
        }
        $result = Batch::run($urls);
        echo "endTime". date("Y-m-d H:i:s");

        var_dump(count($result));
    }
}
