<?php

require dirname(__DIR__) . '/core/vendor/autoload.php';

use Slim\Routing\RouteCollectorProxy;

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

$app->group(
    '/api',
    function (RouteCollectorProxy $group) {
        $group->group(
            '/admin',
            function (RouteCollectorProxy $group) {
                $group->any('/users', [App\Controllers\Admin\Users::class, 'process']);
                $group->any('/user-roles', [App\Controllers\Admin\UserRoles::class, 'process']);
            }
        );

        $group->any('/security/login', [App\Controllers\Security\Login::class, 'process']);
        $group->any('/security/logout', [App\Controllers\Security\Logout::class, 'process']);
        $group->any('/user/profile', [App\Controllers\User\Profile::class, 'process']);
    }
);
$app->get('/image/{id}', [App\Controllers\Image::class, 'process']);

try {
    $app->run();
} catch (Throwable $e) {
    http_response_code($e->getCode());
    echo json_encode($e->getMessage());
}
