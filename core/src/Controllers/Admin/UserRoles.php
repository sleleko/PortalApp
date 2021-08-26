<?php

namespace App\Controllers\Admin;

use App\Models\UserRole;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Psr\Http\Message\ResponseInterface;
use Vesp\Controllers\ModelController;

class UserRoles extends ModelController
{

    protected $model = UserRole::class;
    protected $scope = 'users';


    /**
     * @param UserRole|Model $record
     * @return ResponseInterface|null
     */
    protected function beforeSave(Model $record): ?ResponseInterface
    {
        if (!$record->title) {
            return $this->failure('Вы должны указать название группы');
        }

        $check = UserRole::query()->where('title', '=', $record->title);
        if ($record->exists) {
            $check->where('id', '!=', $record->id);
        }
        if ($check->count()) {
            return $this->failure('Это название группы уже используется');
        }

        $scope = $this->getProperty('scope');
        if (is_string($scope)) {
            $record->scope = array_map('trim', explode(',', $scope));
        }

        return null;
    }

    protected function beforeCount(Builder $c): Builder
    {
        if ($query = trim($this->getProperty('query'))) {
            $c->where('title', 'LIKE', "%$query%");
        }

        return $c;
    }

    protected function afterCount(Builder $c): Builder
    {
        $c->select('id', 'title', 'scope');
        $c->withCount('users');

        return $c;
    }
}
