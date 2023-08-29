<?php

namespace Gcal\Register\Controller;

use Psr\Container\ContainerInterface;

abstract class BaseController
{
    protected $renderer = null;
    protected $ci = null;
    protected $logger = null;

    public function __construct(ContainerInterface $ci)
    {
        $this->renderer = $ci['renderer'];
        $this->ci = $ci;
        $this->logger = $ci->logger;
    }
}
