<?php

declare(strict_types=1);

namespace Shared\Infrastructure\EventListener;

use Doctrine\Inflector\InflectorFactory;
use ReflectionClass;
use Shared\Infrastructure\Controller\ApiController;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class ExceptionHandler
{
    public function errorType(Throwable $exception): string
    {
        $inflector = InflectorFactory::create()->build();
        $reflect = new ReflectionClass($exception);
        return $inflector->tableize($reflect->getShortName());
    }

    public function statusCode(Throwable $exception, ApiController $controller): int
    {
        $exceptions = array_merge($controller->exceptions());
        $className = get_class($exception);
        return $exceptions[$className] ?? Response::HTTP_INTERNAL_SERVER_ERROR;
    }

    public function message(Throwable $exception): string
    {
        return $exception->getMessage();
    }
}
