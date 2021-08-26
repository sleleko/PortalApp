<?php

namespace App\Controllers\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Psr\Http\Message\ResponseInterface;
use Vesp\Controllers\ModelController;

class Users extends ModelController
{

    protected $model = User::class;
    protected $scope = 'users';

    public function patch(): ResponseInterface
    {
        if (!$password = $this->getProperty('password')) {
            $this->unsetProperty('password');
        }

        return parent::patch();
    }


    /**
     * @param User|Model $record
     *
     * @return ResponseInterface|null
     */
    protected function beforeSave(Model $record): ?ResponseInterface
    {
        if (!$record->username) {
            return $this->failure('Вы должны указать имя пользователя');
        }
        if (!$record->password) {
            return $this->failure('Вы должны указать пароль');
        }
        if (!$record->fullname) {
            return $this->failure('Вы должны указать ФИО пользователя');
        }
        if (!$record->role_id) {
            return $this->failure('Вы должны выбрать группу пользователя');
        }

        $check = User::query()->where('username', '=', $record->username);
        if ($record->exists) {
            $check->where('id', '!=', $record->id);
        }
        if ($check->count()) {
            return $this->failure('Данное имя пользователя уже используется!');
        }

        return null;
    }

    protected function beforeCount(Builder $c): Builder
    {
        if ($query = trim($this->getProperty('query'))) {
            $c->where(static function (Builder $q) use ($query) {
                $q->where('username', 'LIKE', "%$query%");
                $q->orWhere('fullname', 'LIKE', "%$query%");
            });
        }

        return $c;
    }

    protected function afterCount(Builder $c): Builder
    {
        $c->select('id', 'role_id', 'username', 'fullname', 'email', 'phone', 'active');
        $c->with('role:id,title');

        return $c;
    }
}