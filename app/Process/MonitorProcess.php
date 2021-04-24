<?php
declare(strict_types=1);

namespace App\Process;

use App\Spider\Downloader\FiveDM\Anime;
use Hyperf\Process\AbstractProcess;
use Hyperf\Process\Annotation\Process;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Redis\Redis;


class MonitorProcess extends AbstractProcess
{
    public function handle(): void
    {
//        Anime::get();
//        $logger = $this->container->get(StdoutLoggerInterface::class);
//        while (true) {
//            $redis = $this->container->get(Redis::class);
//            $count = $redis->llen('queue:failed');
//            if ($count > 0) {
//                $logger->warning('The num of failed queue is ' . $count);
//            }
//            sleep(1);
//        }
    }


    /**
     * 进程数量
     * @var int
     */
    public $nums = 1;

    /**
     * 进程名称
     * @var string
     */
    public $name = 'user-process';

    /**
     * 重定向自定义进程的标准输入和输出
     * @var bool
     */
    public $redirectStdinStdout = false;

    /**
     * 管道类型
     * @var int
     */
    public $pipeType = 2;

    /**
     * 是否启用协程
     * @var bool
     */
    public $enableCoroutine = true;


}