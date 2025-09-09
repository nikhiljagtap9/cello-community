<?php

namespace App\Http\Controllers\User;

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
use App\Models\ProjectWing;
use App\Models\UserWingAssignment;


class UserProjectController extends Controller
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
        $wings = ProjectWing::where('project_id', $id)->get();
       // select * from projects join plots on projects.id = plots.project_id where project_id = 3 and project_wing_id = 6;
        return view('user.project.show', compact('project','wings'));
    }

    public function getPlotsByWing($wing_id)
    {
        $plots = Plot::where('project_wing_id', $wing_id)
           // ->where('status', 'Available') // optional filter
            ->get(['id', 'plot_name','status']);
        return response()->json($plots);
    }


    /**
     * Store a newly created resource in storage.
     * add project with FreeLancer A and FreeLancer B
     */
    
    public function assignFreelancersOld(Request $request)
    {
        DB::transaction(function () use ($request) {

            $projectId = $request->project_id; // coming from form

            // --- Create Freelancer A ---
            if ($request->freelancer_a_email) {
                $password = Str::random(8);
                $password = '12345678';
                $freelancerA = User::create([
                    'email'     => $request->freelancer_a_email,
                    'password'  => bcrypt($password),
                    'user_type' => 'freelancer',
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
                    'user_id' => $freelancerA->id,
                    'plot_id'       => $request->plot_id, // selected plot for A       
                ]);

              //  Mail::to($freelancerA->email)->send(new TempPasswordMail($password));
            }

            // --- Create Freelancer B ---
            if ($request->freelancer_b_email) {
                $password = Str::random(8);
                $password = '12345678';
                $freelancerB = User::create([
                    'email'     => $request->freelancer_b_email,
                    'password'  => bcrypt($password),
                    'user_type' => 'freelancer',
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
                    'user_id' => $freelancerB->id,
                    'plot_id'       => $request->plot_id,        
                ]);

              //  Mail::to($freelancerB->email)->send(new TempPasswordMail($password));
            }
        });

        return redirect()->route('user.project.ongoing')
            ->with('success', 'Freelancers assigned to the project successfully.');
    }

    public function assignFreelancersOldsas(Request $request)
    {
        DB::transaction(function () use ($request) {

            $projectId = $request->project_id; // coming from form
            $mainUser  = auth()->user();       // logged in main user

            // Find the plot and update its status to 'Booked'
            $plot = Plot::findOrFail($request->plot_id);
            $plot->status = 'Booked';
            $plot->save();

            // --- Create Freelancer A ---
            if ($request->freelancer_a_email) {
                $password = Str::random(8);
                $password = '12345678'; // static or generate random
                $freelancerA = $mainUser->addChild([
                    'email'     => $request->freelancer_a_email,
                    'password'  => bcrypt($password),
                    'user_type' => 'freelancer',
                ]);

                $freelancerA->details()->create([
                    'first_name' => $request->freelancer_a_first_name,
                    'last_name'  => $request->freelancer_a_last_name,
                    'phone'      => $request->freelancer_a_phone,
                ]);

               

                //  Mail::to($freelancerA->email)->send(new TempPasswordMail($password));
            }

            // --- Create Freelancer B ---
            if ($request->freelancer_b_email) {
                $password = Str::random(8);
                $password = '12345678';
                $freelancerB = $mainUser->addChild([
                    'email'     => $request->freelancer_b_email,
                    'password'  => bcrypt($password),
                    'user_type' => 'freelancer',
                ]);

                $freelancerB->details()->create([
                    'first_name' => $request->freelancer_b_first_name,
                    'last_name'  => $request->freelancer_b_last_name,
                    'phone'      => $request->freelancer_b_phone,
                ]);

               

                //  Mail::to($freelancerB->email)->send(new TempPasswordMail($password));
            }

            // Save assignment
            ProjectFreelancerAssignment::create([
                    'project_id'    => $projectId,
                    'user_id' => $mainUser->id,
                    'plot_id'       => $request->plot_id,
            ]);
        });

        return redirect()->route('user.project.ongoing')
            ->with('success', 'Freelancers assigned to the project successfully.');
    }

    public function assignFreelancers(Request $request)
    {
        // Validation rules
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'plot_id' => 'required|exists:plots,id',
            
            'freelancer_a_email' => [
                'required',
                'email',
                'unique:users,email'
            ],
            'freelancer_b_email' => [
                'required',
                'email',
                'unique:users,email'
            ],
        ],[
            'plot_id.required' => 'Please select a plot before submitting.',
            'plot_id.exists' => 'The selected plot is invalid.',
        ]);

        DB::transaction(function () use ($request) {
            $projectId = $request->project_id;
            $mainUser = auth()->user();

            // Find the plot and update its status
            $plot = Plot::findOrFail($request->plot_id);
            $plot->status = 'Booked';
            $plot->save();

            // Create Freelancer A if email provided
            if ($request->freelancer_a_email) {
                $password = Str::random(8);
                $password = '12345678';
                $freelancerA = $mainUser->addChild([
                    'email' => $request->freelancer_a_email,
                    'password' => bcrypt($password),
                    'user_type' => 'freelancer',
                ]);

                $freelancerA->details()->create([
                    'first_name' => $request->freelancer_a_first_name,
                    'last_name'  => $request->freelancer_a_last_name,
                    'phone'      => $request->freelancer_a_phone,
                    'address'    => $request->freelancer_a_address,
                ]);

                // Assign to wing
                UserWingAssignment::create([
                    'user_id' => $freelancerA->id,
                    'project_wing_id' => $request->project_wing_id,
                    'assigned_by' => $mainUser->id,
                ]);

                //  Mail::to($freelancerA->email)->send(new TempPasswordMail($password));
            }

            // Create Freelancer B if email provided
            if ($request->freelancer_b_email) {
                $password = Str::random(8);
                $password = '12345678';
                $freelancerB = $mainUser->addChild([
                    'email' => $request->freelancer_b_email,
                    'password' => bcrypt($password),
                    'user_type' => 'freelancer',
                ]);

                $freelancerB->details()->create([
                    'first_name' => $request->freelancer_b_first_name,
                    'last_name'  => $request->freelancer_b_last_name,
                    'phone'      => $request->freelancer_b_phone,
                    'address'    => $request->freelancer_b_address,
                ]);

                // Assign to wing
                UserWingAssignment::create([
                    'user_id' => $freelancerB->id,
                    'project_wing_id' => $request->project_wing_id,
                    'assigned_by' => $mainUser->id,
                ]);

                //  Mail::to($freelancerB->email)->send(new TempPasswordMail($password));
            }

            // Save assignment
            ProjectFreelancerAssignment::create([
                'project_id' => $projectId,
                'user_id' => $mainUser->id,
                'plot_id' => $request->plot_id,
            ]);
        });

        return redirect()->route('user.project.ongoing')
            ->with('success', 'Freelancers assigned successfully.');
    }


    public function ongoingProjects()
    {
        $projects = Project::where('user_id', auth()->id())
            ->whereNull('deleted_at') // skip soft deleted
            ->latest()
            ->get();

        return view('user.project.ongoing', compact('projects'));
    }

    public function detail($id)
    {
    
        $project = Project::with(['plots.wing'])->findOrFail($id);

       // Get all wings for this project (including soft-deleted if needed)
        $wings = ProjectWing::where('project_id', $id)
                ->orderBy('plot_label')
                ->get();
        // Get all assigned users and their invited users recursively
        $assignments = $project->freelancerAssignments()->with('user.details', 'user.children.details')->get();


        return view('user.project.details', compact('project', 'wings','assignments'));
    }



    public function getAssignmentsByWingOLD($projectId, $wingId)
    {
        $project = Project::findOrFail($projectId);

        // Get assignments where assigned plot belongs to the selected wing
        $assignments = $project->freelancerAssignments()
            ->whereHas('plot', function($q) use ($wingId) {
                $q->where('project_wing_id', $wingId);
            })
            ->with('user.details', 'plot')
            ->get();
        
        $printedUsers = [];
        $usersTree = [];

        foreach ($assignments as $assignment) {
            $user = $assignment->user;
            // echo '<pre>';
            // print_r($user->id);
            // Load children recursively
            $children = $this->loadChildrenRecursive($user, $printedUsers,$wingId);

            // Only add children to final array (skip main assigned user)
            foreach ($children as $child) {
                $usersTree[] = $child;
            }
        }


        // Flatten user details
        $usersTree = collect($usersTree)->map(function($user) use ($assignments) {
            $assignedPlot = $assignments->firstWhere('user_id', $user->id)->plot ?? null;

            return [
                'id' => $user->id,
                'first_name' => $user->details->first_name ?? '',
                'last_name'  => $user->details->last_name ?? '',
                'address'    => $user->details->address ?? '',
                'phone'      => $user->details->phone ?? '',
                'email'      => $user->email ?? '',
                'invited_by' => $user->invited_by ?? '',
                'invited_by_type' => $user->invited_by_type ?? '',
                'plot_id' => $assignedPlot->id ?? null,   // <-- assigned plot id
                'plot_name' => $assignedPlot->plot_name ?? null,
            ];
        });

        // Get available plots for this project and wing
        $availablePlots = Plot::where('project_id', $projectId)
                            ->where('project_wing_id', $wingId)
                            ->where('status', 'Available')
                            ->get(['id', 'plot_name']);

        return response()->json([
            'users' => $usersTree,
            'plots' => $availablePlots
        ]);

    //  return response()->json($usersTree);
    }

    /**
     * Load children recursively and track duplicates
     * Returns array of children users (excluding the main user)
     */
    private function loadChildrenRecursiveOLD($user, &$printedUsers,$wingId)
    {
        $childrenArray = [];

        if (!isset($user->children)) {
            $user->children = $user->children()->with('details')->get();
        }
      //  echo 'Main Parent '.$user->id.'<br>';
        foreach ($user->children as $child) {
            
            if (in_array($child->id, $printedUsers)) {
                continue;
            }
            // echo 'Child id of parent '.$user->id.'   '.$child->id.'   '.'<br>';
            // Check if child's plot belongs to this wing
            $childAssignment = $child->assignments->first(function($assignment) use ($wingId) {
                return $assignment->plot && $assignment->plot->project_wing_id == $wingId;
            });

            // if (!$childAssignment) {
            //     continue;
            // }


            $printedUsers[] = $child->id;

            // Track parent info
            $child->invited_by = $user->details->first_name . ' ' . $user->details->last_name;
            $child->invited_by_type = $user->user_type;

            // Add this child to array
            $childrenArray[] = $child;

            // Recursively add their children
            $grandChildren = $this->loadChildrenRecursive($child, $printedUsers,$wingId);
            $childrenArray = array_merge($childrenArray, $grandChildren);
        }
// exit;
        return $childrenArray;
    }


public function getAssignmentsByWing($projectId, $wingId)
{
    $project = Project::findOrFail($projectId);

    // Get all users belonging to this wing (assigned or not)
    $usersInWing = User::with(['details', 'assignments.plot', 'children.details'])
        ->whereHas('userWingAssignments', function($q) use ($wingId) {
            $q->where('project_wing_id', $wingId);
        })
        ->get();

    $printedUsers = [];
    $usersTree = [];

    foreach ($usersInWing as $user) {
        if (!in_array($user->id, $printedUsers)) {
            $printedUsers[] = $user->id;

            // Track parent info if exists
            $user->invited_by = $user->parent ? ($user->parent->details->first_name ?? '') . ' ' . ($user->parent->details->last_name ?? '') : '';
            $user->invited_by_type = $user->parent ? $user->parent->user_type : '';

            $usersTree[] = $user;

            // Recursively load children in this wing
            $children = $this->loadChildrenRecursive($user, $printedUsers, $wingId);
            $usersTree = array_merge($usersTree, $children);
        }
    }

    // Flatten user details
    $usersTree = collect($usersTree)->map(function($user) use ($wingId) {
        // Find assigned plot for this wing
        $assignedPlot = $user->assignments->first(function($a) use ($wingId) {
            return $a->plot && $a->plot->project_wing_id == $wingId;
        });

        return [
            'id' => $user->id,
            'first_name' => $user->details->first_name ?? '',
            'last_name'  => $user->details->last_name ?? '',
            'address'    => $user->details->address ?? '',
            'phone'      => $user->details->phone ?? '',
            'email'      => $user->email ?? '',
            'invited_by' => $user->invited_by ?? '',
            'invited_by_type' => $user->invited_by_type ?? '',
            'plot_id'   => $assignedPlot->plot->id ?? null,
            'plot_name' => $assignedPlot->plot->plot_name ?? null,
        ];
    });

    // Get available plots in this wing
    $availablePlots = Plot::where('project_id', $projectId)
        ->where('project_wing_id', $wingId)
        ->where('status', 'Available')
        ->get(['id', 'plot_name']);

    return response()->json([
        'users' => $usersTree,
        'plots' => $availablePlots
    ]);
}

/**
 * Recursively load children in the same wing (assigned or unassigned)
 */
private function loadChildrenRecursive($user, &$printedUsers, $wingId)
{
    $childrenArray = [];

    $children = $user->children()->with(['details', 'assignments.plot', 'userWingAssignments'])->get();

    foreach ($children as $child) {
        if (in_array($child->id, $printedUsers)) continue;

        // Check if child belongs to this wing
        $inWing = $child->userWingAssignments->contains('project_wing_id', $wingId);
        if (!$inWing) continue;

        $printedUsers[] = $child->id;

        // Track parent info
        $child->invited_by = $user->details->first_name . ' ' . $user->details->last_name;
        $child->invited_by_type = $user->user_type;

        $childrenArray[] = $child;

        // Recursively add grandchildren
        $grandChildren = $this->loadChildrenRecursive($child, $printedUsers, $wingId);
        $childrenArray = array_merge($childrenArray, $grandChildren);
    }

    return $childrenArray;
}






    /* plot assign to all user type*/
    public function assignPlot(Request $request)
    {
       
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'plot_id' => 'required|exists:plots,id',
        ]);

        $plot = Plot::where('id', $request->plot_id)
                    ->where('status', 'Available')
                    ->first();

        if (!$plot) {
            return redirect()->back()->with('error', 'Plot is not available.');
        }

        // Assign the plot and change its status
        $plot->status = 'Booked';
        $plot->save();

        // Save the assignment record for this user and plot
        ProjectFreelancerAssignment::create([
            'project_id' => $plot->project_id,
            'user_id' => $request->user_id,
            'plot_id' => $plot->id,
        ]);

        return redirect()->back()->with('success', 'Plot assigned successfully.');
    }

   
   
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
