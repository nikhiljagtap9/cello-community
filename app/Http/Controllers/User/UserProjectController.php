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
                ]);

              //  Mail::to($freelancerB->email)->send(new TempPasswordMail($password));
            }
        });

        return redirect()->route('user.project.ongoing')
            ->with('success', 'Freelancers assigned to the project successfully.');
    }



    public function ongoingProjects()
    {
        $projects = Project::where('status', 'ongoing')
       // ->where('assigned_to', auth()->id()) // optional filter
        ->get();

        return view('user.project.ongoing', compact('projects'));
    }
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $project = Project::with('plots')->findOrFail($id);
        $users = User::where('user_type','user')->get();
        return view('user.project.edit', compact('project', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'user_id' => 'required|exists:users,id',
            'plots.*.plot_name' => 'required',
            'plots.*.plot_size' => 'required',
            'plots.*.plot_location' => 'required',
            'plots.*.plot_dimensions' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $project = Project::findOrFail($id);

            if ($request->hasFile('image')) {
                if ($project->image) {
                    Storage::disk('public')->delete($project->image);
                }
                $imagePath = $request->file('image')->store('projects', 'public');
                $project->image = $imagePath;
            }

            // Project Update
            $project->update([
                'name' => $request->name,
                'description' => $request->description,
                'user_id' => $request->user_id,
            ]);

            // Plot Update 
            $existingPlotIds = $project->plots()->pluck('id')->toArray();
            $submittedPlotIds = [];

            foreach ($request->plots as $plotData) {
                if (isset($plotData['id'])) {
                    $plot = Plot::find($plotData['id']);
                    if ($plot) {
                        $plot->update([
                            'plot_name' => $plotData['plot_name'],
                            'plot_size' => $plotData['plot_size'],
                            'plot_location' => $plotData['plot_location'],
                            'plot_dimensions' => $plotData['plot_dimensions'],
                        ]);
                        $submittedPlotIds[] = $plot->id;
                    }
                } else {
                    $newPlot = Plot::create([
                        'project_id' => $project->id,
                        'plot_name' => $plotData['plot_name'],
                        'plot_size' => $plotData['plot_size'],
                        'plot_location' => $plotData['plot_location'],
                        'plot_dimensions' => $plotData['plot_dimensions'],
                    ]);
                    $submittedPlotIds[] = $newPlot->id;
                }
            }

            // Delete plots that were removed in the form
            $plotsToDelete = array_diff($existingPlotIds, $submittedPlotIds);
            Plot::whereIn('id', $plotsToDelete)->delete();

            DB::commit();
            return redirect()->route('user.project.index')->with('success', 'Project updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Update failed.')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
