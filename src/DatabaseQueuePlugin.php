<?php

namespace Uvodo\DatabaseQueue;

use Framework\Contracts\Container\ContainerInterface;
use Modules\Plugin\Domain\Context;
use Modules\Plugin\Domain\PluginInterface;
use Support\Queue\QueueFactory;

/** @package Uvodo\DatabaseQueue */
class DatabaseQueuePlugin implements PluginInterface
{
    private ContainerInterface $container;
    private QueueFactory $queueFactory;
    private DatabaseQueueService $databaseService;

    public function __construct(
        ContainerInterface $container,
        QueueFactory $queueFactory,
        DatabaseQueueService $databaseService
    ) {
        $this->container = $container;
        $this->queueFactory = $queueFactory;
        $this->databaseService = $databaseService;
    }

    public function boot(Context $context)
    {
        DatabaseQueueContext::$context = $context;

        $this->queueFactory->register($context->getName(), $this->databaseService->getContext());
    }
}
