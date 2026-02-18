<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\SchoolProgram;
use App\Models\SchoolProgramType;
use Illuminate\Http\Request;

class SchoolProgramController extends Controller
{
    public function list(Request $request)
    {
        $schools = School::where('status', 1)->get();
        $selectedSchool = $request->school ?? null;
        $programs = collect();
        $programTypes = collect();

        if ($selectedSchool) {
            $school = School::where('status', 1)->findOrFail($selectedSchool);
            $programTypes = SchoolProgramType::where('status', 1)->get();
            $query = SchoolProgram::with('programType')
                ->where('school_id', $school->id)
                ->where('status', 1);
            if ($request->filled('program_type')) {
                $query->whereIn('program_type_id', $request->program_type);
            }
            if ($request->filled('search_key')) {
                $query->where('title', 'like', '%' . $request->search_key . '%');
            }
            switch ($request->sort_by) {
                case 'name-desc':
                    $query->orderBy('title', 'desc');
                    break;
                default:
                    $query->orderBy('title', 'asc');
            }
            $programs = $query->paginate(6)->appends($request->query());
        }
        return view('frontend.schools.list', compact(
            'school',
            'schools',
            'selectedSchool',
            'programs',
            'programTypes'
        ));
    }

    public function details($id)
    {
        return redirect()->route('schools.list', ['school' => $id]);
    }
    public function programDetails($slug)
    {
        $program = SchoolProgram::with(['school', 'programType'])
            ->where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();
        $relatedPrograms = SchoolProgram::with('programType')
            ->where('school_id', $program->school_id)
            ->where('status', 1)
            ->where('id', '!=', $program->id)
            ->take(3) // limit number of related programs
            ->get();

        return view('frontend.schools.program-details', compact('program','relatedPrograms'));
    }
}
