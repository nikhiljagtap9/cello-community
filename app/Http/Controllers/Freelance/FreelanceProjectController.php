<?php

namespace App\Http\Controllers\Freelance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Plot;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Project;
use App\Models\ProjectFreelancerAssignment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;



class FreelanceProjectController extends Controller
{
    // Add this method:
    public function addProspects(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|unique:users,email',
            'phone'      => 'required|string|max:20',
            'address'    => 'required|string|max:255',
        ]);

        $freelancer = Auth::user();
        // Determine child user_type based on parent
        $childUserType = $freelancer->user_type === 'freelancer' ? 'prospect' : 'sub_prospect';

        $password = Str::random(8);
        $password = '12345678';

        $prospect = $freelancer->addChild([
            'email'     => $validated['email'],
            'password'  => bcrypt($password),
            'user_type' => $childUserType,
        ]);

        $prospect->details()->create([
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'phone'      => $validated['phone'],
            'address'    => $validated['address'],
        ]);

        return response()->json(['success' => true, 'message' => 'Prospect added successfully!']);
    }

    public function showAllProspects()
    {
        $user = Auth::user();
        $freelancerId = $user->id;

        // Determine child user_type based on parent
        $childUserType = $user->user_type === 'freelancer' ? 'prospect' : 'sub_prospect';

        // Fetch all prospects for this freelancer
        $prospects = User::where('parent_id', $freelancerId)
                        ->where('user_type', $childUserType)
                        ->with('details') // load details relation
                        ->latest('created_at') // show most recent first
                        ->get();

        return view('freelance.all-prospects', compact('prospects'));
    }

    public function showAddedProspects()
    {
        $user = Auth::user();
        $freelancerId = $user->id;

        // Determine child user_type based on parent
        $childUserType = $user->user_type === 'freelancer' ? 'prospect' : 'sub_prospect';

        // Fetch all prospects for this freelancer
        $prospects = User::where('parent_id', $freelancerId)
                        ->where('user_type', $childUserType)
                        ->whereNotNull('last_login_at')  // only logged-in prospects
                        ->with('details') // load details relation
                        ->get();

        return view('freelance.added-prospects', compact('prospects'));
    }


     public function showPendingProspects()
    {
        $user = Auth::user();
        $freelancerId = $user->id;

        // Determine child user_type based on parent
        $childUserType = $user->user_type === 'freelancer' ? 'prospect' : 'sub_prospect';

        // Fetch only prospects who have logged in (last_login_at not null)
        $prospects = User::where('parent_id', $freelancerId)
                        ->where('user_type', $childUserType)
                        ->whereNull('last_login_at')  // only logged-in prospects
                        ->with('details') // load details relation
                        ->get();

        return view('freelance.pending-prospects', compact('prospects'));
    }

    public function reward(){
        return view('freelance.reward');
    }

   
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
