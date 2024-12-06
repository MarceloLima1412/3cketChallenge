<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ImageModel
 * @package App\Model
 */
class ImageModel extends Model
{
    protected $table = 'images';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'path',
        'user_id',
        'category_id'
    ];

    protected $casts = [
        'path'          => 'string',
        'user_id'       => 'integer',
        'category_id'   => 'integer'
    ];
}
