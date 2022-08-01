<?php

namespace Uvodo\DatabaseQueue;

use Enqueue\Dbal\DbalConnectionFactory;
use Interop\Queue\Context;
use Support\Queue\QueueInterface;

/** @package Uvodo\DatabaseQueue */
class DatabaseQueueService implements QueueInterface
{
    /** @return Context  */
    public function getContext(): Context
    {
        $driver = env('DB_DRIVER');
        $username = env('DB_USER');
        $password = env('DB_PASSWORD');
        $host = env('DB_HOST');
        $port = env('DB_PORT');
        $db = env('DB_NAME');

        $factory = new DbalConnectionFactory(
            "$driver://$username:$password@$host:$port/$db"
        );
        $context = $factory->createContext();
        $context->createDataBaseTable();

        return $context;
    }
}
