<?php

namespace Simpleweb\BugsnagBundle\Console;

use Symfony\Bundle\FrameworkBundle\Console\Application as BaseApplication;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Application extends BaseApplication
{
    public function __construct(KernelInterface $kernel)
    {
        parent::__construct($kernel);

        // Boot kernel now
        $kernel->boot();

        // Get container
        $container = $kernel->getContainer();

        // Setup Bugsnag to handle our errors
        $this->bugsnag = $container->get('bugsnag.client');

        // Attach to support reporting PHP errors
        set_error_handler(array($this->bugsnag, 'errorHandler'));
    }

    public function renderException($e, $output)
    {
        // Send exception to Bugsnag
        $this->bugsnag->notifyException($e);

        // Call parent function
        parent::renderException($e, $output);
    }
}
