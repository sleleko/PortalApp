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
                $group->any('/users', App\Controllers\Admin\Users::class);
                $group->any('/user-roles', App\Controllers\Admin\UserRoles::class);
            }
        );

        $group->group(
            '/dicts',
            function (RouteCollectorProxy $group) {
                $group->any('/units', App\Controllers\Dicts\Units::class);
            }
        );

        $group->group(
            '/site',
            function (RouteCollectorProxy $group) {
                $group->any('/gpb-images', App\Controllers\Site\GpbImages::class);
            }
        );

        $group->any('/security/login', App\Controllers\Security\Login::class);
        $group->any('/security/logout', App\Controllers\Security\Logout::class);
        $group->any('/user/profile', App\Controllers\User\Profile::class);
    }
);
$app->get('/image/{id}', App\Controllers\Image::class);

try {
    $app->run();
} catch (Throwable $e) {
    http_response_code($e->getCode());
    echo json_encode($e->getMessage());
}
