<?php
declare(strict_types=1);

namespace App\Controllers\Security;

use Psr\Http\Message\ResponseInterface;
//use Vesp\Controllers\Controller;
use Vesp\Helpers\Jwt;
use Vesp\Models\User;

class Login extends \Vesp\Controllers\Security\Login
{
    protected $model = User::class;

    public function post(): ResponseInterface
    {
        $username = trim($this->getProperty('username'));
        $password = trim($this->getProperty('password'));

        /** @var User|null $user */
        $user = (new $this->model())->newQuery()->where('username', $username)->first();
        if ($user && $user->verifyPassword($password)) {
            return !$user->active
                ? $this->failure('This user is not active', 403)
                : $this->success(['token' => Jwt::makeToken($user->id)]);
        }

        return $this->failure('Wrong username or password', 422);
    }
}