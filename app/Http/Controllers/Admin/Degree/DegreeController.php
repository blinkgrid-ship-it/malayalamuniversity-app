<?php

namespace App\Http\Controllers\Admin\Degree;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\DegreeCategory;
use App\Models\FileManager;
use App\Models\Degree;
use App\Models\StudyLevel;

use App\Models\University;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\DB;
use Exception;

class DegreeController extends Controller
{
    use ResponseTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $degree = Degree::leftJoin('universities', 'degrees.university_id', '=', 'universities.id')
                ->leftJoin('study_levels', 'degrees.study_level_id', '=', 'study_levels.id')
                ->leftJoin('countries', 'degrees.country_id', '=', 'countries.id')
                ->select('degrees.*', 'universities.name as universityName', 'study_levels.name as studyLevelsName', 'countries.name as countryName')
                ->orderBy('degrees.id', 'DESC');
            return datatables($degree)
                ->addColumn('banner_image', function ($data) {
                    return '<div class="min-w-160 d-flex align-items-center cg-10">
                            <div class="flex-shrink-0 w-41 h-41 bd-one bd-c-stroke rounded-circle overflow-hidden bg-eaeaea d-flex justify-content-center align-items-center">
                                <img src="' . getFileUrl($data->banner_image) . '" alt="banner_image" class="rounded avatar-xs w-100 h-100 object-fit-cover">
                            </div>
                        </div>';
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == STATUS_ACTIVE) {
                        return '<div class="zBadge zBadge-completed">' . __("Active") . '</div>';
                    } else {
                        return '<div class="zBadge zBadge-deactive">' . __("Deactivate") . '</div>';
                    }
                })
                ->addColumn('action', function ($data) {
                    return
                        '<div class="d-flex align-items-center g-10 justify-content-end">
                            <button onclick="getEditModal(\'' . route('admin.degrees.edit', $data->id) . '\'' . ', \'#edit-modal\')" class="align-items-center bd-c-stroke bd-one bg-transparent d-flex h-25 justify-content-center rounded-circle w-25" title="Edit">
                                 ' . view('partials.icons.edit')->render() . '
                            </button>
                            <button onclick="deleteItem(\'' . route('admin.degrees.delete', $data->id) . '\', \'degreesDataTable\')" class="align-items-center bd-c-stroke bd-one bg-transparent d-flex h-25 justify-content-center rounded-circle w-25" title="Delete">
                                 ' . view('partials.icons.delete')->render() . '
                            </button>
                        </div>';
                })
                ->rawColumns(['status', 'action', 'banner_image'])
                ->make(true);
        }
        $data['pageTitle'] = __("Manage Degrees");
        $data['showDegreeSettings'] = 'show';
        $data['degreetActive'] = 'active';
        $data['university'] = University::where('status', STATUS_ACTIVE)->get();
        $data['country'] = Country::where('status', STATUS_ACTIVE)->get();
        $data['degreeCategory'] = DegreeCategory::where('status', STATUS_ACTIVE)->get();
        $data['studyLevel'] = StudyLevel::where('status', STATUS_ACTIVE)->get();
        return view('admin.degrees.index', $data);
    }

    public function edit($id)
    {
        $data['degreeData'] = Degree::find($id);
        $data['university'] = University::where('status', STATUS_ACTIVE)->get();
        $data['country'] = Country::where('status', STATUS_ACTIVE)->get();
        $data['degreeCategory'] = DegreeCategory::where('status', STATUS_ACTIVE)->get();
        $data['studyLevel'] = StudyLevel::where('status', STATUS_ACTIVE)->get();

        return view('admin.degrees.edit', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'study_level_id' => 'required',
            'details' => 'required',
            'university_id' => 'required',
            'degree_category_id' => 'required',
            'requirement_program' => 'required',
            'requirement_score' => 'required',
            'country_id' => 'required',
            'intake_time' => 'required',
            'duration' => 'required',
            'amount' => 'required',
            'banner_image' => $request->id ? 'nullable|mimes:jpeg,png,jpg,svg,webp|max:1024' : 'required|mimes:jpeg,png,jpg,svg,webp|max:1024',
        ]);
        DB::beginTransaction();
        try {
            $id = $request->id;
            $degree = $id ? Degree::find($id) : new Degree();

            if (Degree::where('slug', getSlug($request->name))->where('id', '!=', $id)->withTrashed()->count() > 0) {
                $slug = getSlug($request->name) . '-' . rand(100000, 999999);
            } else {
                $slug = getSlug($request->name);
            }

            $degree->slug = $slug;
            $degree->name = $request->name;
            $degree->amount = $request->amount;
            $degree->details = $request->details;
            $degree->duration = $request->duration;
            $degree->country_id = $request->country_id;
            $degree->requirement_program = $request->requirement_program;
            $degree->requirement_score = $request->requirement_score;
            $degree->intake_time = $request->intake_time;
            $degree->university_id = $request->university_id;
            $degree->study_level_id = $request->study_level_id;
            $degree->degree_category_id = $request->degree_category_id;
            $degree->status = $request->status ?? STATUS_PENDING;

            if ($request->hasFile('banner_image')) {

                $newFile = new FileManager();
                $uploadedFile = $newFile->upload('degree', $request->banner_image);

                $degree->banner_image = $uploadedFile->id;
            }

            $degree->save();
            DB::commit();

            $message = $request->id ? __('Updated successfully.') : __('Created successfully.');
            return $this->success([], $message);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error([], getMessage($e->getMessage()));
        }
    }

    public function delete($id)
    {
        try {
            $data = Degree::find($id);
            $data->delete();
            return $this->success([], getMessage(DELETED_SUCCESSFULLY));
        } catch (Exception $exception) {
            return $this->error([], getMessage(SOMETHING_WENT_WRONG));
        }
    }
}
