<?php

declare(strict_types=1);
namespace App\Controllers\Site;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use League\Glide\Responses\PsrResponseFactory;
use League\Glide\ServerFactory;
use Psr\Http\Message\ResponseInterface;
use App\Models\GpbImage;
use Slim\Psr7\Stream;
use Throwable;
use Vesp\Controllers\Data\Image;
use Vesp\Controllers\ModelGetController;
use Vesp\Models\File;

class GpbImages extends Image
{
    protected $model = GpbImage::class;
//    public function put(): ResponseInterface
//    {
//        if ($this->getProperty('test') === 1) {
//            return $this->failure('ОЙ',422);
//        }
//        return $this->success('OK',200);
//    }
    public function post(): ResponseInterface
    {
        $dir = env('UPLOAD_DIR');
        $typePassport = $this->getProperty('passportType');
        $passportSeries = $this->getProperty('passportSeries');
        $passportNumber = $this->getProperty('passportNumber');
        $acceptance = $this->getProperty('acceptance');
        $passport = $this->getProperty('passport');
        $agreement = $this->getProperty('agreement');
        $image = $this->getProperty('image');
        if ($typePassport === null) {
            return $this->failure('Не указан тип паспорта',422);
        }
        if ($passportSeries === null) {
            return $this->failure('Не указана серия паспорта',422);
        }
        if ($passportNumber === null) {
            return $this->failure('Не указан номер паспорта',422);
        }
        if ($acceptance === null) {
            return $this->failure('Не загружено заявление на выпуск карты',422);
        }
        if ($passport === null) {
            return $this->failure('Не загружен скан паспорта',422);
        }
        if ($agreement === null) {
            return $this->failure('Не дано согласие на обработку персональных данных',422);
        }
        if ($image === null) {
            return $this->failure('Не загружена фотография',422);
        }
        $upload_dir = '/var/www/html/upload/';
        if(file_put_contents($upload_dir.'acceptance/FC_'.$passportSeries.'_'.$passportNumber.'_001000_acceptance.pdf', base64_decode(explode(',', $acceptance['file'])[1])) && file_put_contents($upload_dir.'passport/FC_'.$passportSeries.'_'.$passportNumber.'_001000_passport.pdf', base64_decode(explode(',', $passport['file'])[1])) && file_put_contents($upload_dir.'photos/FC_'.$passportSeries.'_'.$passportNumber.'_001000.jpg', base64_decode(explode(',', $image['file'])[1]))) {
            return $this->success('Спасибо, данные получены',200);
        } else {
            return $this->failure('Произошла ошибка при отправке формы',422);
        };
//        return $this->success($this->getProperty('passportSeries'),200);
//        try {
//            /** @var Model $record */
//            $record = new $this->model();
//            $record->fill($this->getProperties());
//            if ($check = $this->beforeSave($record)) {
//                return $check;
//            }
//            $record->save();
//            $record = $this->afterSave($record);
//
//            return $this->success($this->prepareRow($record));
//        } catch (Throwable $e) {
//            return $this->failure($e->getMessage(), 500);
//        }
    }

//    public function get(): ResponseInterface
//    {
//        $id = $this->getPrimaryKey();
//        /** @var File $file */
//        if (!$id || !$file = (new $this->model())->newQuery()->find($id)) {
//            return $this->response->withStatus(404);
//        }
//        if (strpos($file->type, 'image/') !== 0) {
//            return $this->response->withStatus(422);
//        }
//
//        $server = ServerFactory::create(
//            [
//                'base_url' => $this->request->getUri()->getPath(),
//                'source' => $file->getFilesystem()->getBaseFilesystem(),
//                'cache' => rtrim(getenv('CACHE_DIR') ?: sys_get_temp_dir(), '/') . '/image_cache/',
//            ]
//        );
//
//        $response = new PsrResponseFactory(
//            $this->response,
//            static function ($stream) {
//                return new Stream($stream);
//            }
//        );
//        $server->setResponseFactory($response);
//        $path = implode('/', [$file->path, $file->file]);
//
//        return $server->getImageResponse($path, $this->getProperties());
//    }
////    public function get(): ResponseInterface
////    {
////        if ($this->getProperty('test') === 1) {
////            return $this->failure('Работает',422);
////        }
////    }
//
//    /**
//     * @param Model $record
//     * @return ResponseInterface|null
//     */
//    public function beforeSave(Model $record): ?ResponseInterface
//    {
//        if (!$record->passportType) {
//            return $this->failure('Вы не указали тип паспорта', 422);
//        } elseif (!$record->passportSeries) {
//            return $this->failure('Вы не указали серию паспорта',422);
//        } elseif (!$record->passportNumber) {
//            return $this->failure('Вы не указали номер паспорта',422);
//        }
//        if ($image = $this->getProperty('new_image', $this->getProperty('image'))) {
//            if (is_array($image) && !empty($image['file'])) {
//                if (!$file = $record->image) {
//                    $file = new GpbImage();
//                }
//
//                if ($id = $file->uploadBase64($image['file'], $image['metadata'])) {
//                    $record->image_id = $id;
//                }
//            }
//        }
//
//
////        return parent::beforeSave($record); // TODO: Change the autogenerated stub
//    }
//
//    /**
//     * @param Builder $c
//     *
//     * @return Builder
//     */
//    protected function beforeCount(Builder $c): Builder
//    {
//        $this->setProperty('limit', 0);
//        return $c;
//    }
//
//
//    /**
//     * @param Builder $c
//     *
//     * @return Builder
//     */
//    protected function afterCount(Builder $c): Builder
//    {
//        return $c;
//    }
}