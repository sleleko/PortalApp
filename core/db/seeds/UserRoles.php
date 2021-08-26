<?php

use Phinx\Seed\AbstractSeed;
use Vesp\Models\UserRole;

class UserRoles extends AbstractSeed
{
    public function run()
    {
        $roles = [
            'Администратор' => [
                'scope' => ['profile', 'users', 'debug'],
            ],
            'Пользователь' => [
                'scope' => ['profile'],
            ],
            'Администратор ВКР' => [
                'scope' => ['vkr'],
            ],
        ];

        foreach ($roles as $group => $data) {
            if (!$record = UserRole::query()->where('title', '=', $group)->first()) {
                $record = new UserRole(['title' => $group]);
            }
            $record->fill($data);
            $record->save();
        }
    }
}
