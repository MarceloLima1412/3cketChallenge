<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryModel
 * @package App\Model
 */
class CategoryModel extends Model
{
    protected $table = 'categories';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'name',
        'user_id'
    ];

    protected $casts = [
        'name'          => 'string',
        'user_id'       => 'integer'
    ];
}
