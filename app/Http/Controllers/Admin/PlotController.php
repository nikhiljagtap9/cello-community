<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plot;
use App\Models\User;
use App\Models\Project;
use App\Models\ProjectWing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with(['plots.wing', 'user'])
        ->whereHas('plots') // only projects that have at least 1 plot
        ->latest()
        ->get();
        return view('admin.plot.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::latest()->get(); // fetch all projects
        $users = User::where('user_type','user')->latest()->get();
        return view('admin.plot.create',compact('users','projects'));
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'user_id'    => 'required|exists:users,id',
            'plot_label' => 'required|string',
            'image' => 'nullable|image',
            'plots.*.plot_name'      => 'required|string',
            'plots.*.plot_size'      => 'nullable|string',
            'plots.*.plot_location'  => 'nullable|string',
            'plots.*.plot_dimensions'=> 'nullable|string',
        ], [
            'project_id.required' => 'Please select a project.',
            'project_id.exists'   => 'The selected project is invalid.',
            'user_id.required'    => 'Please select a user.',
            'user_id.exists'      => 'The selected user is invalid.',
            'plot_label.required' => 'Please enter a plot label.',
            'plots.required' => 'At least one plot is required.',
            'plots.*.plot_name.required' => 'Plot Name is required for each plot.',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // Update project with user_id
                $project = Project::findOrFail($request->project_id);
                $project->user_id = $request->user_id;
                $project->save();

                if ($request->hasFile('image')) {
                    $imagePath = $request->file('image')->store('projects', 'public');
                }

                // Create project wing
                $wing = ProjectWing::create([
                    'plot_label' => $request->plot_label,
                    'project_id' => $request->project_id,
                    'image' => $imagePath ?? null,
                ]);

                // Create plots
                foreach ($request->plots as $plot) {
                    $plot['project_id']      = $project->id;
                    $plot['project_wing_id'] = $wing->id;
                    $plot['status']          = 'Available'; // adjust type if enum/bool
                    Plot::create($plot);
                }
            });

            return redirect()
                ->route('admin.plot.index')
                ->with('success', 'Plot(s) added successfully!');
        } catch (\Throwable $e) {
            \Log::error('Plot Store Error', ['message' => $e->getMessage()]);
            return redirect()
                ->back()
                ->with('error', 'Something went wrong: '.$e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Get the plot being edited
        $plot = Plot::with('project','wing')->findOrFail($id);

        // Fetch all projects (for dropdown)
        $projects = Project::whereHas('plots')->latest()->get();

        // Fetch all users
        $users = User::where('user_type', 'user')->latest()->get();

        // Fetch all plots that belong to the same project and same wing
        $relatedPlots = Plot::where('project_id', $plot->project_id)
            ->where('project_wing_id', $plot->project_wing_id)
            ->get();

        return view('admin.plot.edit', compact('users', 'projects', 'plot', 'relatedPlots'));
    }


    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'user_id'    => 'required|exists:users,id',
            'plot_label' => 'required|string',
            'image' => 'nullable|image',
            'plots.*.plot_name'       => 'required|string',
            'plots.*.plot_size'       => 'nullable|string',
            'plots.*.plot_location'   => 'nullable|string',
            'plots.*.plot_dimensions' => 'nullable|string',
        ], [
            'project_id.required' => 'Please select a project.',
            'project_id.exists'   => 'The selected project is invalid.',
            'user_id.required'    => 'Please select a user.',
            'user_id.exists'      => 'The selected user is invalid.',
            'plot_label.required' => 'Please enter a plot label.',
            'plots.required' => 'At least one plot is required.',
            'plots.*.plot_name.required' => 'Plot Name is required for each plot.',
        ]);


        try {
            DB::transaction(function () use ($request, $id) {
                // Find the plot first
                $plot = Plot::with('project', 'wing')->findOrFail($id);
                
                // Get the related project
                $project = $plot->project;

                // Update Project
                $project->update([
                    'user_id' => $request->user_id,
                ]);

                // Update or create Wing
                $wing = $plot->wing; // directly from this plot
                if ($request->hasFile('image')) {
                    if ($wing && $wing->image) {
                        Storage::disk('public')->delete($wing->image);
                    }

                    $imagePath = $request->file('image')->store('projects', 'public');

                    if ($wing) {
                        $wing->update([
                            'plot_label' => $request->plot_label,
                            'image' => $imagePath,
                        ]);
                    } else {
                        $wing = $project->wings()->create([
                            'plot_label' => $request->plot_label,
                            'image' => $imagePath,
                        ]);
                    }
                } else {
                    if ($wing) {
                        $wing->update([
                            'plot_label' => $request->plot_label,
                        ]);
                    } else {
                        $wing = $project->wings()->create([
                            'plot_label' => $request->plot_label,
                        ]);
                    }
                }


                // Sync plots under this project
                $existingPlotIds   = $project->plots()->pluck('id')->toArray();
                $submittedPlotIds  = [];

                foreach ($request->plots as $plotData) {
                    if (isset($plotData['id'])) {
                        // Update existing
                        $existing = Plot::find($plotData['id']);
                        if ($existing) {
                            $existing->update([
                                'plot_name'       => $plotData['plot_name'],
                                'plot_size'       => $plotData['plot_size'] ?? null,
                                'plot_location'   => $plotData['plot_location'] ?? null,
                                'plot_dimensions' => $plotData['plot_dimensions'] ?? null,
                                'project_wing_id' => $wing->id,
                            ]);
                            $submittedPlotIds[] = $existing->id;
                        }
                    } else {
                        // Create new
                        $new = Plot::create([
                            'project_id'      => $project->id,
                            'project_wing_id' => $wing->id,
                            'plot_name'       => $plotData['plot_name'],
                            'plot_size'       => $plotData['plot_size'] ?? null,
                            'plot_location'   => $plotData['plot_location'] ?? null,
                            'plot_dimensions' => $plotData['plot_dimensions'] ?? null,
                            'status'          => 'Available',
                        ]);
                        $submittedPlotIds[] = $new->id;
                    }
                }

                // Delete removed plots
                $plotsToDelete = array_diff($existingPlotIds, $submittedPlotIds);
                if (!empty($plotsToDelete)) {
                    Plot::whereIn('id', $plotsToDelete)->delete();
                }
            });

            return redirect()
                ->route('admin.plot.index')
                ->with('success', 'Plot updated successfully.');
        } catch (\Throwable $e) {
            \Log::error('Plot Update Error', ['message' => $e->getMessage()]);
            return redirect()
                ->back()
                ->with('error', 'Something went wrong: '.$e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the plot
        $plot = Plot::findOrFail($id);

        // Get its wing
        $wing = $plot->wing;

        // Delete the plot
        $plot->delete();

        // If wing exists and has no more plots, delete the wing too
        if ($wing && $wing->plots()->count() === 0) {
            $wing->delete();
        }

        return redirect()->route('admin.plot.index')->with('success', 'Plot deleted successfully.');
    }

}
