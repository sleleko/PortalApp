<?php

declare(strict_types=1);

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
     * @param Model $record
     * @return ResponseInterface|null
     */
    protected function beforeSave(Model $record): ?ResponseInterface
    {
        if (!$record->title) {
            return $this->failure('You should specify a title');
        }

        $check = UserRole::query()->where('title', '=', $record->title);
        if ($record->exists) {
            $check->where('id', '!=', $record->id);
        }
        if ($check->count()) {
            return $this->failure('This title is already in use');
        }

        $scope = $this->getProperty('scope');
        if (is_string($scope)) {
            $record->scope = array_map('trim', explode(',', $scope));
        }

        return null;
    }


    /**
     * @param Builder $c
     *
     * @return Builder
     */
    protected function beforeCount(Builder $c): Builder
    {
        if ($query = trim($this->getProperty('query'))) {
            $c->where('title', 'LIKE', "%$query%");
        }

        return $c;
    }


    /**
     * @param Builder $c
     *
     * @return Builder
     */
    protected function afterCount(Builder $c): Builder
    {
        $c->select('id', 'title', 'scope');
        $c->withCount('users');

        return $c;
    }
}
