<?php

namespace App\Controllers\Dicts;

use App\Models\Unit;
use Vesp\Controllers\ModelController;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Psr\Http\Message\ResponseInterface;

class Units extends ModelController
{

    protected $model = Unit::class;


    /**
     * @param Model $record
     * @return ResponseInterface|null
     */
    protected function beforeSave(Model $record): ?ResponseInterface
    {
        if (!$record->title) {
            return $this->failure('Название подразделения не может быть пустым');
        }

        $checkRecord = Unit::query()->where('title','=',$record->title);

        if ($checkRecord->count()) {
            return $this->failure('Подразделение с таким названием уже создано');
        }
        return null;
    }


    protected function afterSave(Model $record): Model
    {
        return parent::afterSave($record);
    }

    /**
     * @param Builder $c
     *
     * @return Builder
     */
    protected function beforeCount(Builder $c): Builder
    {
        $this->setProperty('limit', 0);
        return $c;
    }


    /**
     * @param Builder $c
     *
     * @return Builder
     */
    protected function afterCount(Builder $c): Builder
    {
        return $c;
    }
}