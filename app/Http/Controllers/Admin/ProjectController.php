<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Plot;
use App\Models\User;
use App\Models\Project;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('plots', 'user')->latest()->get();
        return view('admin.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('user_type','user')->latest()->get();
        return view('admin.project.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
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
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('projects', 'public');
            }

            $project = Project::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $imagePath ?? null,
                'user_id' => $request->user_id,
            ]);

            foreach ($request->plots as $plot) {
                $plot['project_id'] = $project->id;
                Plot::create($plot);
            }

            DB::commit();
            return redirect()->route('admin.project.index')->with('success', 'Project created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Something went wrong.')->withInput();
        }
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
        $project = Project::with('plots')->findOrFail($id);
        $users = User::where('user_type','user')->get();
        return view('admin.project.edit', compact('project', 'users'));
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
            return redirect()->route('admin.project.index')->with('success', 'Project updated successfully.');
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
