<?php

use App\Models\User;
use Phinx\Seed\AbstractSeed;

class Users extends AbstractSeed
{
    public function getDependencies()
    {
        return ['UserRoles'];
    }

    public function run()
    {
        $users = [
            'admin' => [
                'password' => 'admin',
                'fullname' => 'Admin',
                'role_id' => 1,
            ],
            'user' => [
                'password' => 'user',
                'fullname' => 'User',
                'role_id' => 2,
            ],
        ];

        foreach ($users as $user => $data) {
            if (!$record = User::query()->where('username', '=', $user)->first()) {
                $record = new User(['username' => $user]);
            }
            $record->fill($data);
            $record->save();
        }
    }
}
