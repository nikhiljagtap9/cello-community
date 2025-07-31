<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'address'    => 'nullable|string|max:255',
            'phone'      => 'required|string|max:20',
            'email'      => 'required|email|unique:users,email',
            'passport'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:1024',
            'picture'    => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'password'   => 'required|string|min:6|confirmed',
        ]);

        // Create the user
        $user = User::create([
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => 'user'
        ]);

        // Initialize file paths
        $passportPath = null;
        $picturePath = null;

        // Handle Passport Upload
        if ($request->hasFile('passport')) {
            $passportFile = $request->file('passport');
            $passportPath = $passportFile->store("passports/{$user->id}", 'public');
        }

        // Handle Picture Upload
        if ($request->hasFile('picture')) {
            $pictureFile = $request->file('picture');
            $picturePath = $pictureFile->store("pictures/{$user->id}", 'public');
        }

        // Save details to UserDetail table
        UserDetail::create([
            'user_id'    => $user->id,
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'address'    => $request->address,
            'phone'      => $request->phone,
            'passport'   => $passportPath,
            'picture'    => $picturePath,
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'address'    => 'nullable|string|max:255',
            'phone'      => 'required|string|max:20',
            'email'      => 'required|email|unique:users,email,' . $id,
            'passport'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:1024',
            'picture'    => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'password'   => 'nullable|string|min:6|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        // get user details data using relation mention in user model against user details
        $detail = $user->details;

        $passportPath = $detail->passport ?? null;
        $picturePath  = $detail->picture ?? null;

        // Handle Passport File Upload and Delete Old
        if ($request->hasFile('passport')) {
            if ($passportPath && Storage::disk('public')->exists($passportPath)) {
                Storage::disk('public')->delete($passportPath);
            }
            $passportPath = $request->file('passport')->store("passports/{$user->id}", 'public');
        }

        // Handle Picture File Upload and Delete Old
        if ($request->hasFile('picture')) {
            if ($picturePath && Storage::disk('public')->exists($picturePath)) {
                Storage::disk('public')->delete($picturePath);
            }
            $picturePath = $request->file('picture')->store("pictures/{$user->id}", 'public');
        }

        if ($detail) {
            $detail->update([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'address'    => $request->address,
                'phone'      => $request->phone,
                'passport'   => $passportPath,
                'picture'    => $picturePath,
            ]);
        } else {
            UserDetail::create([
                'user_id'    => $user->id,
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'address'    => $request->address,
                'phone'      => $request->phone,
                'passport'   => $passportPath,
                'picture'    => $picturePath,
            ]);
        }

        return redirect()->route('admin.user.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Delete related UserDetail and its files
        if ($user->detail) {
            // Delete passport file
            if ($user->detail->passport && \Storage::disk('public')->exists($user->detail->passport)) {
                \Storage::disk('public')->delete($user->detail->passport);
            }

            // Delete picture file
            if ($user->detail->picture && \Storage::disk('public')->exists($user->detail->picture)) {
                \Storage::disk('public')->delete($user->detail->picture);
            }

            // Delete user detail record
            $user->detail->delete();
        }

        // Delete user record
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'User deleted successfully.');
    }

}
