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
        return view('admin.project.create');
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
        ]);

        try {
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('projects', 'public');
            }

            $project = Project::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $imagePath ?? null,
            ]);
            return redirect()->route('admin.project.index')->with('success', 'Project created successfully.');
        } catch (\Exception $e) {
            \Log::error('Plot Store Error', ['message' => $e->getMessage()]);
            return redirect()
                ->back()
                ->with('error', 'Something went wrong: '.$e->getMessage())
                ->withInput();
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
        return view('admin.project.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
        ]);

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
            ]);

            return redirect()->route('admin.project.index')->with('success', 'Project updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Update failed.')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::with(['plots', 'wings'])->findOrFail($id);

        // Soft delete all plots
        foreach ($project->plots as $plot) {
            $plot->delete();
        }

        // Soft delete all wings
        foreach ($project->wings as $wing) {
            $wing->delete();
        }

        // Soft delete the project
        $project->delete();

        return redirect()->route('admin.project.index')->with('success', 'Project deleted successfully.');
    }

}
