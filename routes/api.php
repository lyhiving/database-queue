<?php

use Framework\Routing\Route;

return [
    new Route('PUT', '/', \Uvodo\DatabaseQueue\Presentation\Api\RequestHandlers\CreatUpdateSettingsRequestHandler::class),
];

