<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Models\File as FileObject;
use Psr\Http\Message\ResponseInterface;
use Vesp\Controllers\ModelGetController;

class File extends ModelGetController
{
    /**
     * @return ResponseInterface
     */
    public function get(): ResponseInterface
    {
        /** @var FileObject $file */
        if ($file = FileObject::query()->find($this->getPrimaryKey())) {
            $body = $this->response->getBody();
            $body->write($file->getFile());

            return $this->response
                ->withBody($body)
                ->withHeader('Content-Type', $file->type)
                ->withHeader('Content-Disposition', 'attachment; filename="' . $file->title . '"');
        }

        return $this->response->withStatus(404);
    }
}
