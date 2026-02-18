<?php

namespace App\Http\Controllers\Admin\Degree;

use App\Http\Controllers\Controller;
use App\Models\DegreeCategory;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\DB;
use Exception;

class DegreeCategoryController extends Controller
{
    use ResponseTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $degreeCategory = DegreeCategory::query()->orderBy('id','DESC');
            return datatables($degreeCategory)
                ->addIndexColumn()
                ->addColumn('status', function ($data) {
                    if ($data->status == STATUS_ACTIVE) {
                        return '<div class="zBadge zBadge-completed">'.__("Active").'</div>';
                    } else {
                        return '<div class="zBadge zBadge-deactive">'.__("Deactivate").'</div>';
                    }
                })
                ->addColumn('action', function ($data) {
                    return
                        '<div class="d-flex align-items-center g-10 justify-content-end">
                            <button onclick="getEditModal(\'' . route('admin.degrees.categories.edit', $data->id) . '\'' . ', \'#edit-modal\')" class="align-items-center bd-c-stroke bd-one bg-transparent d-flex h-25 justify-content-center rounded-circle w-25" title="Edit">
                                 ' . view('partials.icons.edit')->render() . '
                            </button>
                            <button onclick="deleteItem(\'' . route('admin.degrees.categories.delete', $data->id) . '\', \'degreeCategoryDataTable\')" class="align-items-center bd-c-stroke bd-one bg-transparent d-flex h-25 justify-content-center rounded-circle w-25" title="Delete">
                                 ' . view('partials.icons.delete')->render() . '
                            </button>
                        </div>';
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        $data['pageTitle'] = __("Manage Degree Categories");
        $data['showDegreeSettings'] = 'show';
        $data['showDegreeCategorySettings'] = 'active';
        return view('admin.degrees.categories.index', $data);
    }

    public function edit($id)
    {
        $data['degreeCategoryData'] = DegreeCategory::find($id);

        return view('admin.degrees.categories.edit', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $id = $request->id;
            $degreeCategory = $id ? DegreeCategory::find($id) : new DegreeCategory();

            $degreeCategory->name = $request->name;
            $degreeCategory->status = $request->status ?? STATUS_PENDING;

            $degreeCategory->save();
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
            $data = DegreeCategory::find($id);
            $data->delete();
            return $this->success([], getMessage(DELETED_SUCCESSFULLY));
        } catch (Exception $exception) {
            return $this->error([], getMessage(SOMETHING_WENT_WRONG));
        }
    }
}
