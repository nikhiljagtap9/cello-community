<?php

namespace App\Http\Controllers\Prospect;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Plot;
use App\Models\User;
use App\Models\Project;

class ProspectDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get all direct sub_freelancers under this freelancer
        $subFreelancers = User::where('parent_id', $user->id)
                            ->where('user_type', 'sub_freelancer')
                            ->get();

        // For each sub_freelancer, fetch their prospects + stats
        $subFreelancers->map(function ($sub) {
            $childUserType = 'sub_prospect';

            // Fetch latest 5 prospects
            $sub->prospects = User::where('parent_id', $sub->id)
                                ->where('user_type', $childUserType)
                                ->with('details')
                                ->latest()
                                ->take(5)
                                ->get();

            // Stats
            $totalInvited = User::where('parent_id', $sub->id)
                                ->where('user_type', $childUserType)
                                ->count();

            $addedProspects = User::where('parent_id', $sub->id)
                                ->where('user_type', $childUserType)
                                ->whereNotNull('last_login_at')
                                ->count();

            $pendingProspects = $totalInvited - $addedProspects;

            $sub->totalInvited    = $totalInvited;
            $sub->addedProspects  = $addedProspects;
            $sub->pendingProspects = $pendingProspects;
        });
        
        return view('prospect.dashboard', compact('user', 'subFreelancers'));
    }


}
