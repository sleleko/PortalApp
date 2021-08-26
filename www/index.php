<?php

require dirname(__DIR__) . '/core/vendor/autoload.php';

try {
    $dotenv = new Symfony\Component\Dotenv\Dotenv(true);
    $dotenv->loadEnv(dirname(__DIR__) . '/core/.env');
} catch (Throwable $e) {
    exit($e->getMessage());
}

$app = DI\Bridge\Slim\Bridge::create();
$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->add(App\Middlewares\Auth::class);
$app->add(new RKA\Middleware\IpAddress());
$app->get('/image/{id:\d+}[/{size:\d+x\d+}[/{params}]]', App\Controllers\Image::class);
$app->get('/file/{id:\d+}[/{params}]', App\Controllers\File::class);
$group = $app->any('/api[/{name:.+}]', App\Controllers\Action::class);

if (getenv('ENV') === 'dev') {
    $group->add(Vesp\Middlewares\Clockwork::class);
    $app->get('/__clockwork/{id:(?:[0-9-]+|latest)}[/{direction:(?:next|previous)}[/{count:\d+}]]', Vesp\Controllers\Data\Clockwork::class);
}

try {
    $app->run();
} catch (Throwable $e) {
    http_response_code($e->getCode());
    echo json_encode($e->getMessage());
}
