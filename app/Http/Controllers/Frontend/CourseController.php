<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Faq;
use App\Models\Program;
use App\Models\Testimonial;
use App\Models\StudyLevel;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function list(Request $request)
    {
        
        $data['pageTitle'] = 'Courses';
        $data['faqData'] = Faq::where('status',STATUS_ACTIVE)->get();
        $data['bodyClass'] = 'bg-white';

        $query = Course::query();

        // Apply the search key filter if present in the request
        if ($request->has('search_key') && !empty($request->get('search_key'))) {

            $searchKey = $request->get('search_key');
            $query->where(function ($q) use ($searchKey) {
                $q->where('title', 'like', "%{$searchKey}%")
                    ->orWhere('description', 'like', "%{$searchKey}%"); // Adjust fields based on what you want to search
            });
        }

         if ($request->has('study_level') && !empty($request->get('study_level'))) {

                $query->whereIn('level_id', $request->get('study_level'));
         }

         
         if ($request->has('programms') && !empty($request->get('programms'))) {

                $query->whereIn('program_id', $request->get('programms'));
         }

        // Apply sorting if sort_by is present in the request
        if ($request->has('sort_by')) {
            switch ($request->get('sort_by')) {
                case 'name-asc':
                    $query->orderBy('title', 'asc');
                    break;
                case 'name-desc':
                    $query->orderBy('title', 'desc');
                    break;
                default:
                    // Default sorting if none selected (optional)
                    $query->orderBy('title', 'asc');
                    break;
            }
        }
                    
        // Paginate the filtered/sorted results
        $data['courses']    = $query->paginate(6)->appends($request->query());

        $data['studyLevel'] = StudyLevel::where('status', 1)->get();
        $data['programms']  = Program::where('status',operator: 1)->get();
        $data['activeCoursesMenu'] = request()->routeIs('courses.list') ? 'active' : '';
       

        return view('frontend.courses.list', $data);
    }

    public function courseProgram($slug)
    {
        $program = Program::where('status', STATUS_ACTIVE)->where('slug', $slug)->firstOrFail();
        $data['pageTitle'] = __($program->title);
        $data['program'] = $program;
        $data['testimonialData'] = Testimonial::where('status',STATUS_ACTIVE)->get();
        $data['faqData'] = Faq::where('status',STATUS_ACTIVE)->get();
        $data['activeCourseProgram'.$data['program']->id] = 'active';
        $data['activeProgramMenu'] = 'active';
        $data['bodyClass'] = 'bg-white';
        $data['courses'] = Course::where('status', STATUS_ACTIVE)->where('program_id', $program->id)->withCount('lessons')->get();
        return view('frontend.courses.programs', $data);
    }

    public function course($slug)
    {
        $course = Course::where('status', STATUS_ACTIVE)
            ->with(['program', 'lessons'])
            ->where('slug', $slug)
            ->firstOrFail();
        $data['pageTitle'] = __($course->title);
        $data['activeCourseProgram'.$course->program_id] = 'active';
        $data['activeProgramMenu'] = 'active';
        $data['bodyClass'] = 'bg-white';
        $data['course'] = $course;

        


        return view('frontend.courses.single-course', $data);
    }

    public function video($slug){

        $data['resource'] = Course::where('slug',$slug)->first();
        return view('frontend.courses.resource-view', $data);
    }

}
