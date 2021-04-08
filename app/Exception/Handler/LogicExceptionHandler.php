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
namespace App\Exception\Handler;

use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class LogicExceptionHandler extends ExceptionHandler
{
    /**
     * @var StdoutLoggerInterface
     */
    protected $logger;


    public function __construct(StdoutLoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        // 判断被捕获到的异常是希望被捕获的异常
        if ($throwable instanceof \LogicException) {
            // 格式化输出
            $data = json_encode([
                'code' => $throwable->getCode(),
                'message' => $throwable->getMessage(),
                'data'=>[]
            ]);
            // 阻止异常冒泡
            $this->stopPropagation();
            return $response->withStatus(500)->withBody(new SwooleStream($data));
        }

        // 交给下一个异常处理器
        return $response;

        // 或者不做处理直接屏蔽异常
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
