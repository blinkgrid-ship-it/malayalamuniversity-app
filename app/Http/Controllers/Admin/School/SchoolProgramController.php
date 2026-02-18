<?php

namespace App\Http\Controllers\Admin\School;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\SchoolProgramType;
use App\Models\SchoolProgram;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class SchoolProgramController extends Controller
{
    use ResponseTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $programs = SchoolProgram::with(['school', 'programType'])->orderBy('sort_order', 'ASC');

            return datatables($programs)
                ->addColumn('banner_image', function($data){
                        return '<div class="min-w-160 d-flex align-items-center cg-10">
                            <div class="flex-shrink-0 w-41 h-41 bd-one bd-c-stroke rounded-circle overflow-hidden bg-eaeaea d-flex justify-content-center align-items-center">
                                <img src="'.getFileUrl($data->banner_image).'" alt="banner_image" class="rounded avatar-xs w-100 h-100 object-fit-cover">
                            </div>
                        </div>';
                    })
                ->addColumn('school', fn($data) => $data->school ? $data->school->title : '-')
                ->addColumn('program_type', fn($data) => $data->programType ? $data->programType->title : '-')
                ->addColumn('status', fn($data) =>
                    $data->status
                        ? '<div class="zBadge zBadge-completed">' . __("Active") . '</div>'
                        : '<div class="zBadge zBadge-deactive">' . __("Deactivate") . '</div>'
                )
                ->addColumn('action', function($data) {
    return '
        <div class="d-flex align-items-center g-10 justify-content-end">
            <button onclick="getEditModal(\''.route('admin.schools.programs.edit', $data->id).'\', \'#add-modal\')" class="align-items-center bd-c-stroke bd-one bg-transparent d-flex h-25 justify-content-center rounded-circle w-25" title="Edit">
                '.view('partials.icons.edit')->render().'
            </button>
            <button onclick="deleteItem(\''.route('admin.schools.programs.delete', $data->id).'\', \'programsDataTable\')" class="align-items-center bd-c-stroke bd-one bg-transparent d-flex h-25 justify-content-center rounded-circle w-25" title="Delete">
                '.view('partials.icons.delete')->render().'
            </button>
        </div>';
})

                ->rawColumns(['banner_image','status','action'])
                ->make(true);
        }

        return view('admin.school.programs.index', [
            'pageTitle' => __('Manage School Programs'),
            'schools' => School::where('status',1)->get(),
            'programTypes' => SchoolProgramType::where('status',1)->get(),
            'activePrograms'=> 'active',
            'showManageSchool' => 'show'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'school_id' => 'required|exists:schools,id',
            'program_type_id' => 'required|exists:school_program_types,id',
            'title' => 'required|string|max:255',
            'status' => 'required|in:0,1',
             'banner_image' => $request->id ? 'nullable|mimes:jpeg,png,jpg,svg,webp|max:1024' : 'required|mimes:jpeg,png,jpg,svg,webp|max:1024',
        ]);

        DB::beginTransaction();
        try {
            $program = $request->id ? SchoolProgram::findOrFail($request->id) : new SchoolProgram();

            $program->school_id = $request->input('school_id');
            $program->program_type_id = $request->input('program_type_id');
            $program->title = $request->input('title');
            $program->subtitle = $request->input('subtitle') ?? null;
            $program->slug = \Str::slug($request->input('title'));
            $program->content_type = 'html'; // fixed
            $program->content = $request->input('content') ?? '';
            $program->sort_order = $request->input('sort_order') ?? 0;
            $program->meta_title = $request->input('meta_title') ?? null;
            $program->meta_description = $request->input('meta_description') ?? null;
            $program->meta_keywords = $request->input('meta_keywords') ?? null;
            $program->og_image = $request->input('og_image') ?? null;
            $program->status = $request->input('status');
            if ($request->hasFile('banner_image')) {
            $newFile = new \App\Models\FileManager();
            $uploadedFile = $newFile->upload('program', $request->banner_image);
            $program->banner_image = $uploadedFile->id;
        }

            $program->save();

            DB::commit();
            return $this->success([], $request->id ? __('Updated successfully.') : __('Created successfully.'));
        } catch(Exception $e){
            DB::rollBack();
            return $this->error([], $e->getMessage());
        }
    }

    public function edit($id)
{
    $program = SchoolProgram::findOrFail($id);

    // Return JSON for modal
    return response()->json([
        'id' => $program->id,
        'school_id' => $program->school_id,
        'program_type_id' => $program->program_type_id,
        'title' => $program->title,
        'subtitle' => $program->subtitle,
        'content' => $program->content,
        'status' => $program->status,
        'sort_order' => $program->sort_order,
        'banner_image' => $program->banner_image ? url($program->banner_image) : null
    ]);
}


    public function delete($id)
    {
        try {
            $program = SchoolProgram::findOrFail($id);
            $program->delete();
            return $this->success([], __('Deleted successfully'));
        } catch(Exception $e){
            return $this->error([], $e->getMessage());
        }
    }
}
