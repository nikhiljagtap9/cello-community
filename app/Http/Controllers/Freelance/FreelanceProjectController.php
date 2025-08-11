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


class FreelanceProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function newProjects()
    {
        $userId = auth()->id();

        // Fetch projects assigned to the logged-in user
        $projects = Project::where('user_id', $userId)
            ->whereNull('deleted_at') // skip soft deleted
            ->latest()
            ->get();

        return view('user.project.new', compact('projects'));
    }

    public function show($id)
    {
        $project = Project::with('plots')->findOrFail($id);

        return view('user.project.show', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     * add project with FreeLancer A and FreeLancer B
     */
    
    public function assignFreelancers(Request $request)
    {
        DB::transaction(function () use ($request) {

            $projectId = $request->project_id; // coming from form

            // --- Create Freelancer A ---
            if ($request->freelancer_a_email) {
                $password = Str::random(8);
                $password = 'niksjagtap';
                $freelancerA = User::create([
                    'email'     => $request->freelancer_a_email,
                    'password'  => bcrypt($password),
                    'user_type' => 'freelance',
                    'parent_id' => auth()->id(),
                ]);

                UserDetail::create([
                    'user_id'    => $freelancerA->id,
                    'first_name' => $request->freelancer_a_first_name,
                    'last_name'  => $request->freelancer_a_last_name,
                    'phone'      => $request->freelancer_a_phone,
                ]);

                // Save assignment
                ProjectFreelancerAssignment::create([
                    'project_id'    => $projectId,
                    'freelancer_id' => $freelancerA->id,
                    'plot_id'       => $request->plot_a_id, // selected plot for A
                    'role'          => 'A',
                    'status'          => 'ongoing',
                ]);

              //  Mail::to($freelancerA->email)->send(new TempPasswordMail($password));
            }

            // --- Create Freelancer B ---
            if ($request->freelancer_b_email) {
                $password = Str::random(8);
                $password = 'niksjagtap';
                $freelancerB = User::create([
                    'email'     => $request->freelancer_b_email,
                    'password'  => bcrypt($password),
                    'user_type' => 'freelance',
                    'parent_id' => auth()->id(),
                ]);

                UserDetail::create([
                    'user_id'    => $freelancerB->id,
                    'first_name' => $request->freelancer_b_first_name,
                    'last_name'  => $request->freelancer_b_last_name,
                    'phone'      => $request->freelancer_b_phone,
                ]);

                ProjectFreelancerAssignment::create([
                    'project_id'    => $projectId,
                    'freelancer_id' => $freelancerB->id,
                    'plot_id'       => $request->plot_b_id,
                    'role'          => 'B',
                    'status'          => 'ongoing',
                ]);

              //  Mail::to($freelancerB->email)->send(new TempPasswordMail($password));
            }
        });

        return redirect()->route('user.project.ongoing')
            ->with('success', 'Freelancers assigned to the project successfully.');
    }



    public function ongoingProjects()
    {
        $projects = Project::where('user_id', auth()->id()) // main user who owns the project
            ->whereHas('freelancerAssignments', function ($query) {
                $query->where('status', 'ongoing');
            })
            ->get();

        return view('user.project.ongoing', compact('projects'));
    }

    public function detail($id)
    {
        $project = Project::with([
            'plots',
            'freelancerAssignments.freelancer',
           // 'freelancerAssignments.invitedUsers'
        ])
        ->where('id', $id)
        ->firstOrFail();

        return view('user.project.details', compact('project'));
    }

   
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
