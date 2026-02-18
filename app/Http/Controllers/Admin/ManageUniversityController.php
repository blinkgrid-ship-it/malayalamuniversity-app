<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\University;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ManageUniversityController extends Controller
{
    // List universities
    // public function index()
    // {
    //     $universities = University::with('admin')->get();
    //     return view('admin.universities.index', compact('universities'));
    // }
    public function index()
{
    $universities = University::with('admin')->get();

    return view('admin.universities.index', [
        'universities' => $universities,
        'activeUniveristies' => 'active',
    ]);
}


    // Show create form
    public function create()
    {
        return view('admin.universities.create',  [
        'activeUniveristies' => 'active',
    ]);
    }

    // Store university & admin
    public function store(Request $request)
    {
        $request->validate([
            'university_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'world_ranking' => 'nullable|numeric',
            'avg_cost' => 'nullable|numeric',
            'feature' => 'nullable|boolean',
            'top_university' => 'nullable|boolean',
            'logo' => 'nullable|string',
            'thumbnail_image' => 'nullable|string',
            'country_id' => 'nullable|numeric',
            'details' => 'nullable|string',
            'core_benefits_title' => 'nullable|array',
            'core_benefits_icon' => 'nullable|array',
            'gallery_image' => 'nullable|array',
        ]);

        // Step 1: Create University Admin User first
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 1, // University role
            'user_type' => 'university',
            'status' => 1,
        ]);

        // Assign Role
        $user->assignRole('University');

        // Step 2: Create University with admin user_id
        $university = University::create([
            'user_id' => $user->id, // Link the admin user
            'name' => $request->university_name,
            'slug' => Str::slug($request->university_name),
            'world_ranking' => $request->world_ranking ?? 0,
            'avg_cost' => $request->avg_cost ?? 0,
            'feature' => $request->feature ?? 0,
            'top_university' => $request->top_university ?? 0,
            'status' => 1,
            'logo' => $request->logo ?? null,
            'thumbnail_image' => $request->thumbnail_image ?? null,
            'country_id' => $request->country_id ?? null,
            'details' => $request->details ?? '',
            'core_benefits_title' => $request->core_benefits_title ?? [],
            'core_benefits_icon' => $request->core_benefits_icon ?? [],
            'gallery_image' => $request->gallery_image ?? [],
        ]);

        // Step 3: Update user with university_id
        $user->update([
            'university_id' => $university->id
        ]);

        return redirect()->route('admin.universities.index')
            ->with('success', 'University & Admin created successfully');
    }

    // updates
    // Toggle Active / Inactive
public function toggleStatus($id)
{
    $university = University::findOrFail($id);
    $university->status = !$university->status;
    $university->save();

    // Also update the admin user's status
    if($university->admin) {
        $university->admin->status = $university->status;
        $university->admin->save();
    }

    return redirect()->back()->with('success', 'Status updated successfully');
}

// Soft Delete University and its Admin
public function destroy($id)
{
    $university = University::findOrFail($id);

    // Soft delete admin user
    if($university->admin) {
        $university->admin->delete();
    }

    // Soft delete university
    $university->delete();

    return redirect()->back()->with('success', 'University deleted successfully');
}

}
