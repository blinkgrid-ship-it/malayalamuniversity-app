<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'university_id',
        'title',
        'subtitle',
        'slug',
        'description',
        'thumbnail',
        'status',
        'created_by'
    ];
}
