<?php

declare(strict_types=1);

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

    /**
     * @return ResponseInterface
     */
    public function patch(): ResponseInterface
    {
        if (!$password = $this->getProperty('password')) {
            $this->unsetProperty('password');
        }

        return parent::patch();
    }

    /**
     * @param Model $record
     * @return ResponseInterface|null
     */
    protected function beforeSave(Model $record): ?ResponseInterface
    {
        if (!$record->username) {
            return $this->failure('You should specify an username');
        }
        if (!$record->password) {
            return $this->failure('You should specify a password');
        }
        if (!$record->fullname) {
            return $this->failure('You should specify a full name');
        }
        if (!$record->role_id) {
            return $this->failure('You should specify an user group');
        }

        $check = User::query()->where('username', '=', $record->username);
        if ($record->exists) {
            $check->where('id', '!=', $record->id);
        }
        if ($check->count()) {
            return $this->failure('This username is already in use');
        }

        return null;
    }

    /**
     * @param Builder $c
     * @return Builder
     */
    protected function beforeCount(Builder $c): Builder
    {
        if ($query = trim($this->getProperty('query'))) {
            $c->where(
                function (Builder $q) use ($query) {
                    $q->where('username', 'LIKE', "%$query%");
                    $q->orWhere('fullname', 'LIKE', "%$query%");
                }
            );
        }

        return $c;
    }

    /**
     * @param Builder $c
     * @return Builder
     */
    protected function afterCount(Builder $c): Builder
    {
        $c->select('id', 'role_id', 'username', 'fullname', 'email', 'phone', 'active');
        $c->with('role:id,title');

        return $c;
    }
}
