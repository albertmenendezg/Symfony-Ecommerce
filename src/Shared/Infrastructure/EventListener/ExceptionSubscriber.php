<?php

declare(strict_types=1);

namespace Shared\Infrastructure\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class ExceptionSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private ExceptionHandler $exceptionHandler
    ) {
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $controllerName = $event->getRequest()->attributes->get('_controller');
        $exception = $event->getThrowable();
        $status = $controllerName ?
            $this->exceptionHandler->statusCode($exception, new $controllerName()) :
            (
            method_exists($exception, 'getStatusCode') ?
                $exception->getStatusCode() :
                Response::HTTP_BAD_REQUEST
            );
        $event->setResponse(
            new JsonResponse(
                [
                    'error_type' => $this->exceptionHandler->errorType($exception),
                    'message' => $this->exceptionHandler->message($exception),
                ],
                $status,
            ),
        );
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }
}
