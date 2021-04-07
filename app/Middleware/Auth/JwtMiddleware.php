<?php

declare(strict_types=1);

namespace App\Middleware\Auth;

use Hyperf\Validation\ValidationException;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use HyperfExt\Jwt\Jwt;

class JwtMiddleware implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    protected $jwt;


    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            $token = $this->jwt->getTokenObj();
            if ($this->jwt->checkToken()) {
                $userId = $token->getClaim('user_id');
                $user = User::where('user_id', $userId)->where('status', User::STATUS_ENABLE)->first();
                if (!$user) {
                    throw new ValidationException('Token未验证通过', 401);
                }
                $request = $request->withAttribute('user', $user);
                Context::set(ServerRequestInterface::class, $request);
            }
        } catch (\Exception $e) {
            throw new TokenValidException('Token未验证通过', 401);
        }
        return $handler->handle($request);
    }
}