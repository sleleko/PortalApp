<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Unit
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 */
class Unit extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title',
    ];
}