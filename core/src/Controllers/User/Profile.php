<?php

declare(strict_types=1);

namespace App\Controllers\User;
use Psr\Http\Message\ResponseInterface;

class Profile extends \Vesp\Controllers\User\Profile
{
    public function get(): ResponseInterface
    {
        return parent::get(); // TODO: Change the autogenerated stub
    }

    public function patch(): ResponseInterface
    {
        return parent::patch(); // TODO: Change the autogenerated stub
    }
}
