<?php
declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Vesp\Models\File;

/**
 * @property int $id
 * @property string $author
 * @property string $title_vkr
 * @property int $type_vkr
 * @property string $scientific_director
 * @property int $year_pub
 * @property int $count_pages
 * @property string|null $keywords
 * @property string|null $annotation
 * @property int $file_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read File $file
 */
class VkrWork extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'author',
        'title_vkr',
        'type_vkr',
        'scientific_director',
        'year_pub',
        'count_pages',
        'keywords',
        'annotation',
        'file_id',
    ];
//    protected $casts = [
//        'metadata' => 'array',
//    ];

    /**
     * @return BelongsTo
     */
    public function file()
    {
        return $this->belongsTo(File::class);
    }
}