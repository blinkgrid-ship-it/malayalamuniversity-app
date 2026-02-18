<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolProgram extends Model
{
    use HasFactory;

    protected $table = 'school_programs';

    protected $fillable = [
        'school_id',
        'program_type_id',
        'title',
        'subtitle',
        'slug',
        'content_type',
        'content',
        'document_file',
        'sort_order',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_image',
        'banner_image',
        'created_by',
        'status',
    ];

    // Relationships
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function programType()
    {
        return $this->belongsTo(SchoolProgramType::class, 'program_type_id');
    }
    public function edit($id)
{
    $program = SchoolProgram::findOrFail($id);
    $schools = School::all();
    $programTypes = SchoolProgramType::all();
    $pageTitle = 'Edit Program';

    return view('admin.school.programs.edit', compact('program', 'schools', 'programTypes', 'pageTitle'));
}
}
