<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    // Login page
    public function index() {
        return view('category.login');
    }

    // Signup page
    public function create() {
        return view('category.signup');
    }

    // Store new user
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'gender' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email|unique:categories,email',
            'password' => 'required|string|min:6',
        ]);

        Category::create([
            'name' => $request->name,
            'age' => $request->age,
            'gender' => $request->gender,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'projects' => json_encode([]),
        ]);

        return redirect('/login')->with('success', 'Account created! You can now login.');
    }

    // Login
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = Category::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('user_id', $user->id);
            Session::put('user_name', $user->name);
            return redirect('/homepage')->with('success', 'Logged in successfully!');
        }

        return back()->withErrors(['email' => 'Invalid credentials. Forgot your password?'])->withInput();
    }

    // Logout
    public function logout() {
        Session::flush();
        return redirect('/login')->with('success', 'Logged out successfully!');
    }

    // Homepage
    public function homepage() {
        if (!Session::has('user_id')) {
            return redirect('/login')->withErrors(['error' => 'You must be logged in']);
        }
        return view('category.homepage');
    }

    // Profile page
    public function profile() {
        $user = Category::find(Session::get('user_id'));
        $projects = $user->projects ? json_decode($user->projects, true) : [];
        return view('category.profile', compact('user','projects'));
    }

    // Update profile (bio + picture)
    public function updateProfile(Request $request) {
        $user = Category::find(Session::get('user_id'));

        $request->validate([
            'bio' => 'nullable|string|max:1000',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $path = $file->store('profile_pics', 'public');
            $user->profile_picture = $path;
        }

        $user->bio = $request->bio;
        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    // Add project
    public function addProject(Request $request) {
        $user = Category::find(Session::get('user_id'));
        $projects = $user->projects ? json_decode($user->projects, true) : [];

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $projects[] = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        $user->projects = json_encode($projects);
        $user->save();

        return back()->with('success', 'Project added successfully!');
    }

    // Delete project
    public function deleteProject($index) {
        $user = Category::find(Session::get('user_id'));
        $projects = $user->projects ? json_decode($user->projects, true) : [];

        if (isset($projects[$index])) {
            array_splice($projects, $index, 1);
            $user->projects = json_encode($projects);
            $user->save();
            return back()->with('success', 'Project deleted successfully!');
        }

        return back()->withErrors(['error' => 'Project not found']);
    }
}
