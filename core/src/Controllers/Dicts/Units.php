<?php

namespace App\Controllers\Dicts;

use App\Models\Unit;
use Vesp\Controllers\ModelController;
use Illuminate\Database\Eloquent\Builder;
use Psr\Http\Message\ResponseInterface;

class Units extends ModelController
{

    protected $model = Unit::class;


    /**
     * @param Unit $record
     * @return bool|string
     */
    protected function beforeSave($record)
    {
        if (!$record->title) {
            return 'Название подразделения не может быть пустым';
        }

        $checkRecord = Unit::query()->where('title','=',$record->title);
        if ($checkRecord->count()) {
            return 'Подразделение с таким названием уже создано';
        }
        return true;
    }


    protected function afterSave($record)
    {
        return parent::afterSave($record);
    }

    /**
     * @param Builder $c
     *
     * @return Builder
     */
    protected function beforeCount($c)
    {
        $this->setProperty('limit', 0);
        return $c;
    }


    /**
     * @param Builder $c
     *
     * @return Builder
     */
    protected function afterCount($c)
    {
        return $c;
    }
}