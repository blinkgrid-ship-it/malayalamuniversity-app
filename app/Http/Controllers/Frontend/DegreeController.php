<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Degree;
use App\Models\School;
use App\Models\StudyLevel;
use App\Models\DegreeCategory;
use App\Models\University;
use Illuminate\Http\Request;

class DegreeController extends Controller
{
    public function list(Request $request)
    {
        $query = Degree::leftJoin('countries','degrees.country_id','=','countries.id')
            ->leftJoin('degree_categories','degrees.degree_category_id','=','degree_categories.id')
            ->leftJoin('universities','degrees.university_id','=','universities.id')
            ->leftJoin('study_levels','degrees.study_level_id','=','study_levels.id')
            ->select(
                'degrees.*',
                'countries.name as countryName',
                'universities.name as universityName',
                'degree_categories.name as degreeCategoryName',
                'study_levels.name as studyLevelName'
            )
            ->where('degrees.status', STATUS_ACTIVE);

        // Filter by country
        if ($request->has('country') && !empty($request->country)) {
            $countryIds = $request->country;
            $query->whereIn('degrees.country_id', $countryIds);

            $universities = University::whereIn('country_id', $countryIds)
                ->where('status', STATUS_ACTIVE)
                ->get();
        } else {
            $universities = University::where('status', STATUS_ACTIVE)->get();
        }

        // Filter by university
        if ($request->has('university') && !empty($request->university[0])) {
            $query->whereIn('degrees.university_id', $request->university);
        }

        // Filter by degree category
        if ($request->has('degree_category') && !empty($request->degree_category)) {
            $query->whereIn('degrees.degree_category_id', $request->degree_category);
        }

        // Filter by study level
        if ($request->has('study_level') && !empty($request->study_level[0])) {
            $query->whereIn('study_level_id', $request->study_level);
        }

        $studyLevel = StudyLevel::where('status', STATUS_ACTIVE)->get();

        // Search functionality
        if ($request->has('search_key') && !empty($request->get('search_key'))) {
            $searchKey = $request->get('search_key');
            $query->where(function ($q) use ($searchKey) {
                $q->where('degrees.name', 'like', "%{$searchKey}%")
                  ->orWhere('degrees.details', 'like', "%{$searchKey}%");
            });
        }

        // Sorting
        if ($request->has('sort_by')) {
            switch ($request->get('sort_by')) {
                case 'name-asc':
                    $query->orderBy('degrees.name', 'asc');
                    break;
                case 'name-desc':
                    $query->orderBy('degrees.name', 'desc');
                    break;
                default:
                    $query->orderBy('degrees.name', 'asc');
                    break;
            }
        }

        $data['degreeData'] = $query->paginate(6)->appends($request->query());
        $data['countries'] = Country::where('status', STATUS_ACTIVE)->get();
        $data['degreeCategory'] = DegreeCategory::where('status', STATUS_ACTIVE)->get();
        $data['universities'] = $universities;
        $data['studyLevel'] = $studyLevel;
        $data['pageTitle'] = __('Degrees');
        $data['activeDegreeMenu'] = 'active';
        $data['activeDegreesMenu'] = 'active';
        $data['bodyClass'] = 'bg-white';
        $data['schools'] = School::where('status', STATUS_ACTIVE)
            // ->whereHas('degrees') // only schools with degrees
            ->get();
        $data['selectedSchool'] = $request->school ?? null;
        return view('frontend.degrees.list', $data);
    }

    public function details($slug)
    {
        $data['activeDegreeMenu'] = 'active';
        $data['activeDegreesMenu'] = 'active';
        $data['bodyClass'] = 'bg-white';

        $data['degreeDetails'] = Degree::leftJoin('countries','degrees.country_id','=','countries.id')
            ->leftJoin('degree_categories', 'degrees.degree_category_id', '=', 'degree_categories.id')
            ->leftJoin('universities','degrees.university_id','=','universities.id')
            ->leftJoin('study_levels','degrees.study_level_id','=','study_levels.id')
            ->select(
                'degrees.*',
                'countries.name as countryName',
                'universities.name as universityName',
                'study_levels.name as studyLevelName',
                'degree_categories.name as degreeCategoryName',
            )
            ->where('degrees.slug', $slug)
            ->first();

       

        $data['exploreDegrees'] = Degree::leftJoin('countries', 'degrees.country_id', '=', 'countries.id')
            ->leftJoin('degree_categories', 'degrees.degree_category_id', '=', 'degree_categories.id')
            ->leftJoin('universities', 'degrees.university_id', '=', 'universities.id')
            ->leftJoin('study_levels', 'degrees.study_level_id', '=', 'study_levels.id')
            ->where('degrees.id', '!=', $data['degreeDetails']->id)
            ->select(
                'degrees.name as degreeName',
                'degrees.intake_time as degreeIntakeTime',
                'degrees.slug as degreeSlug',
                'degrees.banner_image as degreeBannerImage',
                'countries.name as countryName',
                'universities.name as universityName',
                'degree_categories.name as degreeCategoryName',
                'study_levels.name as studyLevelName'
            )
            ->where('degrees.degree_category_id', $data['degreeDetails']->degree_category_id)
            ->get();

             $data['schools'] = School::where('status', STATUS_ACTIVE)
            // ->whereHas('degrees') // only schools with degrees
            ->get();
        return view('frontend.degrees.details', $data);
    }
}
