<?php

declare(strict_types=1);

namespace Mothership\Handlers;

use Mothership\Mothership;
use Mothership\MothershipLogger;
use Mothership\Payload\Level;

abstract class AbstractHandler
{
    protected $registered = false;

    protected $previousHandler = null;

    public function __construct(
        protected MothershipLogger $logger
    ) {
    }

    public function logger()
    {
        return $this->logger;
    }

    public function registered()
    {
        return $this->registered;
    }

    public function handle(...$args)
    {
        if (!$this->registered()) {
            throw new \Exception(get_class($this) . ' has not been set up.');
        }
    }

    public function register()
    {
        $this->registered = true;
    }
}
