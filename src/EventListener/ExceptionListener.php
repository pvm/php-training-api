<?php
namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        // If debug is enabled, return exception with details
        if (getenv('APP_DEBUG') == true) {
            return;
        }

        // You get the exception object from the received event
        $exception = $event->getException();

        // Define Response
        $response = new JsonResponse();
        $response
            ->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR)
            ->setData([
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ]);

        // HttpExceptionInterface is a special type of exception that holds status code and header details
        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
        }

        // Send the modified response object to the event
        $event->setResponse($response);
    }
}