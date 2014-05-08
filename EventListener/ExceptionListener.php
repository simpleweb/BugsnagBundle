<?php

namespace Simpleweb\BugsnagBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent,
    Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * The BugsnagBundle ExceptionListener.
 *
 * Handles exceptions that occur in the code base.
 */
class ExceptionListener
{
    protected $client;

    /**
     * @param \Bugsnag_Client $client
     */
    public function __construct(\Bugsnag_Client $client)
    {
        $this->client = $client;
    }

    /**
     * Method for handling the actual exceptions
     *
     * @param  \Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent $event [description]
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if ($exception instanceof HttpException) {
            return;
        }

        $this->client->notifyException($exception);

        error_log($exception->getMessage().' in: '.$exception->getFile().':'.$exception->getLine());
    }
}
