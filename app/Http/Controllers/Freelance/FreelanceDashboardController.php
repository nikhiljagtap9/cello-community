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
        $totalPlots = Plot::count();
        $newPlots = Plot::whereDate('created_at', '>=', now()->subDays(7))->count();

        $totalUsers = User::where('user_type', 'user')->count();
        $newUsers = User::where('user_type', 'user')
                        ->whereDate('created_at', '>=', now()->subDays(7))
                        ->count();

        $totalProjects = Project::count();
        $newProjects = Project::whereDate('created_at', '>=', now()->subDays(7))->count();

        $user = Auth::user();
        
        return view('freelance.dashboard', compact(
            'totalPlots', 'newPlots',
            'totalUsers', 'newUsers',
            'totalProjects', 'newProjects',
            'user'
        ));
    }
}
