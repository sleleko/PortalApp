<?php


namespace App\Controllers\Admin;

use App\Models\VkrWork;
use Vesp\Models\File;
use Illuminate\Database\Eloquent\Model;
use Throwable;
use Vesp\Controllers\ModelController;
use Illuminate\Database\Eloquent\Builder;
use Psr\Http\Message\ResponseInterface;


class VkrWorks extends ModelController
{
    protected $model = VkrWork::class;
//    protected $scope = 'vkr';

    /**
     * @param Builder $c
     * @return Builder|mixed
     */
    protected function beforeGet(Builder $c): Builder
    {
        $c->with('file:id,title,updated_at');

        return $c;
    }

    /**
     * @param Model $record
     * @return ResponseInterface
     */
    protected function beforeSave(Model $record): ?ResponseInterface
    {
        if (!is_numeric($record->year_pub)) {
            return $this->failure('Поле год не может заполняться текстом!',400);
        }
        if (!is_numeric($record->count_pages)) {
            return $this->failure('Поле объем страниц не может заполняться текстом!',400);
        }
        if ($fileData = $this->getProperty('file')) {
            if (is_array($fileData) && !empty($fileData['file'])) {
                if (!$file = $record->file) {
                    $file = new File();
//                    $file->fill([
//                        'title' => base64_decode(explode(',', $fileData['file'])[1])
//                    ]);
//                    $file->save();
                }
                if ($file->uploadFile($fileData['file'], $fileData['metadata'])) {
                    $record->file_id = $file->id;
                    $record->save();
                }
            }
        }
        return null;
    }

    /**
     * @param Model $record
     * @return Model
     */
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
        $c->with('file:id,title,updated_at');
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

//    /**
//     * @param Model $object
//     *
//     * @return array
//     */
//    public function prepareRow(Model $object): array
//    {
//        $array = [
//            'id' => $object->id,
//            'week_id' => $object->week_id,
//            'week' => [
//                'id' => $object->week->id,
//                'title' => $object->week->title,
//            ],
//            'unit_id' => $object->unit_id,
//            'unit' => [
//                'id' => $object->unit->id,
//                'title' => $object->unit->title,
//            ],
//            'number_staff' => $object->number_staff,
//            'accepted_staff' => $object->accepted_staff,
//            'fired_staff' => $object->fired_staff,
//        ];
//
//        return $array;
//    }
}