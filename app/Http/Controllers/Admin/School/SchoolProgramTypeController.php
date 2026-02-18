<?php

namespace App\Http\Controllers\Admin\School;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\SchoolProgramType;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class SchoolProgramTypeController extends Controller
{
    use ResponseTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $types = SchoolProgramType::with('school')->orderBy('sort_order', 'ASC');

            return datatables($types)
                ->addColumn('school', fn($data) => $data->school ? $data->school->title : '-')
                ->addColumn('status', fn($data) => $data->status
                    ? '<div class="zBadge zBadge-completed">' . __("Active") . '</div>'
                    : '<div class="zBadge zBadge-deactive">' . __("Deactivate") . '</div>'
                )
                ->addColumn('action', function($data){
                    return '
                        <div class="d-flex align-items-center g-10 justify-content-end">
                            <button onclick="getEditModal(\''.route('admin.schools.program-types.edit', $data->id).'\', \'#add-modal\')" class="align-items-center bd-c-stroke bd-one bg-transparent d-flex h-25 justify-content-center rounded-circle w-25" title="Edit">
                                '.view('partials.icons.edit')->render().'
                            </button>
                            <button onclick="deleteItem(\''.route('admin.schools.program-types.delete', $data->id).'\', \'schoolProgramTypesDataTable\')" class="align-items-center bd-c-stroke bd-one bg-transparent d-flex h-25 justify-content-center rounded-circle w-25" title="Delete">
                                '.view('partials.icons.delete')->render().'
                            </button>
                        </div>';
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }

        $data['pageTitle'] = __("Manage School Program Types");
        $data['schools'] = School::where('status',1)->get();
        $data['activeProgramTypes'] = 'active';
        $data['showManageSchool'] = 'show';
        return view('admin.school.program-types.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'school_id' => 'required|exists:schools,id',
            'title' => 'required|string|max:255',
            'status' => 'required|in:0,1'
        ]);

        DB::beginTransaction();
        try {
            $query = SchoolProgramType::where('school_id',$request->school_id)
                        ->where('title',$request->title);
            if($request->id) $query->where('id','!=',$request->id);

            if($query->exists()){
                return $this->error([], __('Program type with this title already exists.'));
            }

            $type = $request->id ? SchoolProgramType::findOrFail($request->id) : new SchoolProgramType();
            $type->school_id = $request->school_id;
            $type->title = $request->title;
            $type->short_code = $request->short_code ?? null;
            $type->slug = \Str::slug($request->title);
            $type->description = $request->description ?? null;
            $type->sort_order = $request->sort_order ?? 0;
            $type->status = $request->status;
            $type->save();

            DB::commit();
            return $this->success([], $request->id ? __('Updated successfully.') : __('Created successfully.'));
        } catch (Exception $e){
            DB::rollBack();
            return $this->error([], $e->getMessage());
        }
    }

    // public function edit($id)
    // {
    //     $type = SchoolProgramType::findOrFail($id);
    //     $schools = School::where('status',1)->get();
    //     return view('admin.school.program-types.edit', compact('type','schools'));
    // }
    public function edit($id)
{
    $type = SchoolProgramType::findOrFail($id);

    return response()->json([
        'id' => $type->id,
        'school_id' => $type->school_id,
        'title' => $type->title,
        'short_code' => $type->short_code,
        'sort_order' => $type->sort_order,
        'status' => $type->status,
    ]);
}


    public function delete($id)
    {
        try{
            $type = SchoolProgramType::findOrFail($id);
            $type->delete();
            return $this->success([], __('Deleted successfully'));
        } catch(Exception $e){
            return $this->error([], $e->getMessage());
        }
    }
}
