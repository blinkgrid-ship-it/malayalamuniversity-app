<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DegreeCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'status'
    ];
}
