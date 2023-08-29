<?php
namespace Gcal\Register\Service;

use Psr\Container\ContainerInterface;

abstract class BaseService
{
    protected $ci = null;
    protected $logger = null;

    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
        $this->logger = $ci->logger;
    }

    public function getLogger()
    {
        return $this->logger;
    }
}
