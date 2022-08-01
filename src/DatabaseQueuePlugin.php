<?php

namespace Uvodo\DatabaseQueue;

use Modules\Plugin\Domain\Context;
use Modules\Plugin\Domain\PluginInterface;
use Support\Queue\QueueContextFactory;

/** @package Uvodo\DatabaseQueue */
class DatabaseQueuePlugin implements PluginInterface
{
    private QueueContextFactory $queueFactory;
    private DatabaseQueueService $databaseService;

    /**
     * @param QueueContextFactory $queueFactory 
     * @param DatabaseQueueService $databaseService 
     * @return void 
     */
    public function __construct(
        QueueContextFactory $queueFactory,
        DatabaseQueueService $databaseService
    ) {
        $this->queueFactory = $queueFactory;
        $this->databaseService = $databaseService;
    }

    /**
     * @inheritDoc
     */
    public function boot(Context $context): void
    {
        DatabaseQueueContext::$context = $context;
        $this->queueFactory->register(
            $context->getName()->getValue(),
            $this->databaseService->getContext()
        );
    }
}
