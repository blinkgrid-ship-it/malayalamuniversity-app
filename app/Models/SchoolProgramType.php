<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolProgramType extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'school_id',
        'title',
        'short_code',
        'slug',
        'description',
        'sort_order',
        'status'
    ];
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
