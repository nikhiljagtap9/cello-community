<?php

namespace App\Http\Controllers\Freelance;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Plot;
use App\Models\User;
use App\Models\Project;

class FreelanceDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $freelancerId = auth()->id();

        // Decide which prospect type to fetch based on user_type
        $prospectType = $user->user_type === 'freelancer' ? 'prospect' : 'sub_prospect';

        // Fetch all latest 5 prospects for this freelancer
        $prospects = User::where('parent_id', $freelancerId)
                        ->where('user_type', $prospectType)
                        ->with('details') // load details relation
                        ->latest('created_at') // order by creation time descending
                        ->take(5)
                        ->get();

        // Total invited prospects
        $totalInvited = User::where('parent_id', $freelancerId)
                            ->where('user_type', $prospectType)
                            ->count();

        // Prospects who have logged in at least once
        $addedProspects = User::where('parent_id', $freelancerId)
                            ->where('user_type', $prospectType)
                            ->whereNotNull('last_login_at')
                            ->count();

        // Pending prospects (invited but never logged in)
        $pendingProspects = $totalInvited - $addedProspects;

        return view('freelance.dashboard', compact(
            'user',
            'prospects',
            'totalInvited',
            'addedProspects',
            'pendingProspects'
        ));
    }

}
