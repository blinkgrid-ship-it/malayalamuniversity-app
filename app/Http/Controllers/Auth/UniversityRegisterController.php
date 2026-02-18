<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\University;
use App\Models\MeetingPlatform;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UniversityRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Step 1: Show university details first
     */
    public function showStep1()
    {
        $countries = Country::all(); // Fetch countries for dropdown
        return view('auth.register_university_step1', compact('countries'));
    }

    /**
     * Step 1: Handle university details submission and store in session
     */
    public function postStep1(Request $request)
    {
        $request->validate([
            'university_name' => 'required|string|max:255',
            'country_id' => 'nullable|numeric',
            'world_ranking' => 'nullable|numeric',
            'avg_cost' => 'nullable|numeric',
        ]);

        $request->session()->put('university_details', $request->only(
            'university_name', 'country_id', 'world_ranking', 'avg_cost'
        ));

        return redirect()->route('register.university.step2'); // go to user auth next
    }

    /**
     * Step 2: Show user personal info / auth
     */
    public function showStep2()
    {
        $userData = session('user_info', []); // optional if prefilled
        return view('auth.register_university_step2', compact('userData'));
    }

    /**
     * Step 2: Handle user personal info and complete registration
     */
    public function postStep2(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'agree_policy' => 'required',
        ]);

        $userData = $request->only('first_name','last_name','email','password');

        $universityData = session('university_details');

        if (!$universityData) {
            return redirect()->route('register.university.step1')->with('error', 'Please fill university details first.');
        }

        DB::beginTransaction();
        try {
            $user = User::create([
                'first_name' => $userData['first_name'],
                'last_name' => $userData['last_name'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']),
                'role' => 1,
                'user_type' => 'university',
                'status' => 1,
            ]);

            $user->assignRole('University');

            $university = University::create([
                'user_id' => $user->id,
                'name' => $universityData['university_name'],
                'slug' => Str::slug($universityData['university_name']),
                'world_ranking' => $universityData['world_ranking'] ?? 0,
                'avg_cost' => $universityData['avg_cost'] ?? 0,
                'status' => 1,
                'country_id' => $universityData['country_id'] ?? null,
            ]);

            $user->update(['university_id' => $university->id]);
            MeetingPlatform::createDefaultForUniversity($university->id);
            DB::commit();
            auth()->login($user);

            // Clear sessions
            $request->session()->forget('university_details');
            $request->session()->forget('user_info');

            // return redirect()->route('home')->with('success', 'University registered successfully');
            return redirect('admin/manage/universities/edit-own')->with('success', 'University registered successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
}
