<?php

namespace App\Http\Controllers\Admin\School;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class SchoolController extends Controller
{
    use ResponseTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $schools = School::orderBy('id', 'DESC');

            return datatables($schools)
                ->addColumn('status', function ($data) {
                    return $data->status == STATUS_ACTIVE
                        ? '<div class="zBadge zBadge-completed">' . __("Active") . '</div>'
                        : '<div class="zBadge zBadge-deactive">' . __("Deactivate") . '</div>';
                })
                ->addColumn('action', function ($data) {
                    return '
                        <div class="d-flex align-items-center g-10 justify-content-end">
                            <button onclick="getEditModal(\'' . route('admin.schools.edit', $data->id) . '\', \'#add-modal\')" 
                                class="align-items-center bd-c-stroke bd-one bg-transparent d-flex h-25 justify-content-center rounded-circle w-25" 
                                title="Edit">
                                ' . view('partials.icons.edit')->render() . '
                            </button>
                            <button onclick="deleteItem(\'' . route('admin.schools.delete', $data->id) . '\', \'schoolsDataTable\')" 
                                class="align-items-center bd-c-stroke bd-one bg-transparent d-flex h-25 justify-content-center rounded-circle w-25" 
                                title="Delete">
                                ' . view('partials.icons.delete')->render() . '
                            </button>
                        </div>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        $data['showManageSchool'] = 'show';
        $data['activeSchools'] = 'active';
        $data['pageTitle'] = __("Manage Schools");
        return view('admin.school.index', $data);
    }

    public function edit($id)
    {
        $school = School::findOrFail($id);

        return response()->json([
            'id' => $school->id,
            'title' => $school->title,
            'subtitle' => $school->subtitle,
            'description' => $school->description,
            'status' => $school->status,
            'showManageSchool' => 'show'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:' . STATUS_ACTIVE . ',' . STATUS_DEACTIVATE
        ]);

        DB::beginTransaction();
        try {
            $query = School::where('title', $request->title);
            if ($request->id) {
                $query->where('id', '!=', $request->id);
            }
            if ($query->exists()) {
                return $this->error([], __('School with this title already exists.'));
            }

            $school = $request->id ? School::findOrFail($request->id) : new School();
            $school->title = $request->title;
            $school->subtitle = $request->subtitle ?? null;
            $school->slug = getSlug($request->title);
            $school->description = $request->description ?? null;
            $school->status = $request->status ?? STATUS_PENDING;
            $school->save();

            DB::commit();

            $message = $request->id ? __('Updated successfully.') : __('Created successfully.');
            return $this->success([], $message);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error([], $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $school = School::findOrFail($id);
            $school->delete();
            return $this->success([], __('Deleted successfully'));
        } catch (Exception $e) {
            return $this->error([], $e->getMessage());
        }
    }
}
