<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Blog;
use App\Models\ContactUs;
use App\Models\Country;
use App\Models\Course;
use App\Models\Event;
use App\Models\Faq;
use App\Models\Program;
use App\Models\Service;
use App\Models\StudyLevel;
use App\Models\Subject;
use App\Models\Testimonial;
use App\Models\University;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    use ResponseTrait;

    public function index(Request $request)
    {

       // return redirect('universities-list');
        
        $data['serviceData'] = Service::where('status',STATUS_ACTIVE)->get();
        $howWeWork = json_decode(getOption('how-we-work'), true);
        $data['titles'] = $howWeWork['title'] ?? [];
        $data['descriptions'] = $howWeWork['description'] ?? [];
        $data['countryData'] = Country::where('status',STATUS_ACTIVE)->get();
        $data['universityData'] = University::where(['status'=>STATUS_ACTIVE, 'feature' => STATUS_ACTIVE])->get();
        $data['eventData'] = Event::where('status',STATUS_ACTIVE)->orderby('date_time',"ASC")->get();
        $data['testimonialData'] = Testimonial::where('status',STATUS_ACTIVE)->get();
        $data['faqData'] = Faq::where('status',STATUS_ACTIVE)->get();
        $data['studyLevelsData'] = StudyLevel::where('status',STATUS_ACTIVE)->get();
        $data['subjectData'] = Subject::where('status',STATUS_ACTIVE)->get();
        $data['aboutUs'] = AboutUs::first();
        $data['blogData'] = Blog::leftJoin('users', 'blogs.created_by', '=', 'users.id')
            ->leftJoin('designations', 'designations.id', '=', 'users.designation_id')
            ->select('blogs.*',  DB::raw("CONCAT(users.first_name, ' ', users.last_name) as userName"), 'users.image as userImage', 'designations.title as userDesignation')
            ->where('blogs.status', STATUS_ACTIVE)
            ->take(4)
            ->get();
        $data['programms'] = Program::where('status',1)->get();
        

        foreach($data['programms'] as $key=>$p){

             $data['programms'][$key]['courses'] =  Course::where('courses.status', 1)
             ->where('program_id', $p->id)
        ->latest()
        ->take(9)
        ->get();
        }

        $data['studyLevels'] = StudyLevel::where('status', STATUS_ACTIVE)->get();
       

        // // 1. Universities for listings
        // $data['universities'] = University::where('status', STATUS_ACTIVE)
        //     ->latest()
        //     ->take(6)
        //     ->get();

        // // 2. Courses (Subjects) for listings
        // $data['courses'] = Subject::where('status', STATUS_ACTIVE)
        //     ->latest()
        //     ->take(6)
        //     ->get();

        // // 3. Events for listings (only upcoming)
        // $data['events'] = Event::where('status', STATUS_ACTIVE)
        //     ->whereDate('date_time', '>=', now())
        //     ->orderBy('date_time', 'asc')
        //     ->take(6)
        //     ->get();
        // 1. Universities with country name
    $data['universities'] = University::where('universities.status', STATUS_ACTIVE)
        ->leftJoin('countries', 'universities.country_id', '=', 'countries.id')
        ->select('universities.*', 'countries.name as country_name')
        ->latest()
        ->take(6)
        ->get();

    // 2. Courses (Subjects) with joins
   

    // 3. Events (upcoming)
    $data['events'] = Event::where('status', STATUS_ACTIVE)
        ->whereDate('date_time', '>=', now())
        ->orderBy('date_time', 'asc')
        ->take(6)
        ->get();

$data['religiousStudiesCourses'] = Course::where('status', STATUS_ACTIVE)
    ->where('subject_id', 5)
    ->latest()
    ->get();

$data['performingArtsCourses'] = Course::where('status', STATUS_ACTIVE)
    ->where('subject_id', 3)
    ->latest()
    ->get();

$data['lifeSkillCourses'] = Course::where('status', STATUS_ACTIVE)
    ->where('subject_id', 4)
    ->latest()
    ->get();

        return view('frontend.index',$data);
    }

    public function page($slug)
    {
        $data['bodyClass'] = 'bg-white';
        $data['policyPageTitle'] = getOption($slug . '_title');
        $data['policyPageDetails'] = getOption($slug . '_details');

        return view('frontend.page', $data);
    }

    public function getUniversitiesByCountry($country_id)
    {
        $universities = University::where('country_id', $country_id)
            ->where('status', STATUS_ACTIVE)
            ->get(['id', 'name']);

        return response()->json([
            'status' => true,
            'data' => $universities,
        ]);
    }
    public function getUniversityByCountry(Request $request)
    {
        // Convert comma-separated country IDs to an array
        $countryIdsArray = explode(',', $request->country_ids);

        // Retrieve universities for the given countries
        $universities = University::whereIn('country_id', $countryIdsArray)
            ->where('status', STATUS_ACTIVE)
            ->get(['id', 'name']);

        return response()->json([
            'status' => true,
            'data' => $universities,
        ]);
    }

    public function getSubjectByUniversity(Request $request)
    {
        // Convert comma-separated university IDs to an array
        $universityIdsArray = explode(',', $request->university_ids);

        // Retrieve subjects based on selected universities
        $subjects = Subject::whereIn('university_id', $universityIdsArray)
            ->where('status', STATUS_ACTIVE)
            ->get(['id', 'name']);

        return response()->json([
            'status' => true,
            'data' => $subjects,
        ]);
    }

    public function contactUs(){

        $data['bodyClass'] = '';
        $data['activeContactUsMenu'] = 'active';

        return view('frontend.contact-us',$data);
    }
    public function contactUsStore(Request $request) {

        if (!empty(getOption('recapture_in_contact_us')) && getOption('recapture_in_contact_us') == 1) {
            $validatedData = $request->validate([
                'recaptcha_token' => 'required'
            ]);
            if (!$this->verifyRecaptcha($validatedData['recaptcha_token'])) {
                return back()->withErrors(['recaptcha' => 'reCAPTCHA verification failed. Please try again.']);
            }
        }

        $validated = $request->validate([
            "first_name" => ['required', 'string', 'max:255'],
            "last_name" => ['required', 'string', 'max:255'],
            "email" => ['required', 'email', 'max:255'],
            'mobile' => ['required', 'string', 'min:2', 'max:60'],
            'message' => ['required', 'string'],
        ]);


        DB::beginTransaction();
        try {
            $contactUs = new ContactUs();

            $contactUs->first_name = $request->first_name;
            $contactUs->last_name = $request->last_name;
            $contactUs->mobile = $request->mobile;
            $contactUs->email = $request->email;
            $contactUs->message = $request->message;

            $contactUs->save();
            DB::commit();
            $message = SENT_SUCCESSFULLY;
            return $this->success([], getMessage($message));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error([], getMessage($e->getMessage()));
        }

    }
    public function verifyRecaptcha($token)
    {
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => getOption('google_recaptcha_secret_key'),
            'response' => $token,
        ]);

        $recaptchaData = $response->json();
        return isset($recaptchaData['success'], $recaptchaData['score']) && $recaptchaData['success'] && $recaptchaData['score'] >= 0.5;
    }

    public function getFilteredCourses(Request $request)
{
    $query = Course::where('courses.status', STATUS_ACTIVE)
        ->with(['university', 'university.country', 'studyLevel']);
    
    // Apply filters
    if ($request->has('country') && !empty($request->country)) {
        $query->whereHas('university.country', function($q) use ($request) {
            $q->whereIn('countries.id', (array)$request->country);
        });
    }
    
    if ($request->has('university') && !empty($request->university)) {
        $query->whereIn('courses.university_id', (array)$request->university);
    }
    
    if ($request->has('study_level') && !empty($request->study_level)) {
        $query->whereIn('courses.study_level_id', (array)$request->study_level);
    }
    
    $courses = $query->take(12)->get();
    
    return response()->json([
        'success' => true,
        'html' => view('frontend.partials.courses-listings', compact('courses'))->render()
    ]);
}

public function getFilteredUniversities(Request $request)
{
    $query = University::where('universities.status', STATUS_ACTIVE)
        ->with('country');
    
    if ($request->has('country') && !empty($request->country)) {
        $query->whereIn('universities.country_id', (array)$request->country);
    }
    
    if ($request->has('university') && !empty($request->university)) {
        $query->whereIn('universities.id', (array)$request->university);
    }
    
    $universities = $query->take(12)->get();
    
    return response()->json([
        'success' => true,
        'html' => view('frontend.partials.universities-listings', compact('universities'))->render()
    ]);
}

public function getFilteredEvents(Request $request)
{
    $query = Event::where('status', STATUS_ACTIVE)
        ->whereDate('date_time', '>=', now());
    
    if ($request->has('country') && !empty($request->country)) {
        $query->where(function($q) use ($request) {
            foreach ((array)$request->country as $countryId) {
                $q->orWhereJsonContains('country_ids', (int)$countryId);
            }
        });
    }
    
    if ($request->has('university') && !empty($request->university)) {
        $query->where(function($q) use ($request) {
            foreach ((array)$request->university as $universityId) {
                $q->orWhereJsonContains('university_ids', (int)$universityId);
            }
        });
    }
    
    if ($request->has('study_level') && !empty($request->study_level)) {
        $query->where(function($q) use ($request) {
            foreach ((array)$request->study_level as $studyLevelId) {
                $q->orWhereJsonContains('study_levels', (int)$studyLevelId);
            }
        });
    }
    
    $events = $query->orderBy('date_time', 'asc')->take(12)->get();
    
    return response()->json([
        'success' => true,
        'html' => view('frontend.partials.events-listings', compact('events'))->render()
    ]);
}
}
