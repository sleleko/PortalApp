<?php
declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Vesp\Traits\ModelDtoTrait;

/**
 * @property int $id
 * @property int $passportType
 * @property string $passportSeries
 * @property string $passportNumber
 * @property string $file
 * @property string $path
 * @property string|null $title
 * @property string|null $type
 * @property int|null $width
 * @property int|null $height
 * @property array|null $metadata
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read string $file_path
 * @property-read string $full_file_path
 */
class GpbImage extends Model
{
    use ModelDtoTrait;

    public $timestamps = true;
    protected $fillable = [
        'passportType',
        'passportSeries',
        'passportNumber',
        'file',
        'path',
        'title',
        'type',
        'width',
        'height',
        'size',
        'metadata'
    ];
    protected $casts = [
        'metadata' => 'array',
    ];
}