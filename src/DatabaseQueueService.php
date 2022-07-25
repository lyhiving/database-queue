<?php

namespace Uvodo\DatabaseQueue;

use Enqueue\Dbal\DbalConnectionFactory;
use Enqueue\Fs\FsConnectionFactory;
use Interop\Queue\Context;
use Support\Queue\QueueInterface;

class DatabaseQueueService implements QueueInterface
{
    public function getContext(): Context
    {
        $driver = env('DB_DRIVER');
        $username = env('DB_USER');
        $password = env('DB_PASSWORD');
        $host = env('DB_HOST');
        $port = env('DB_PORT');
        $db = env('DB_NAME');

        $factory = new DbalConnectionFactory("$driver://$username:$password@$host:$port/$db");
        $context = $factory->createContext();
        $context->createDataBaseTable();

        return $context;
    }
}
