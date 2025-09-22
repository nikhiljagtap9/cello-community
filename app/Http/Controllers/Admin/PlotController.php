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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PlotController extends Controller
{
    public function index()
    {
        $projects = Project::with(['plots.wing', 'user'])
            // ->whereHas('plots') // only projects that have at least 1 plot
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

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'user_id'    => 'required|exists:users,id',
            'plot_label' => 'required|string',
            'image' => 'nullable|image',
        ], [
            'project_id.required' => 'Please select a project.',
            'project_id.exists'   => 'The selected project is invalid.',
            'user_id.required'    => 'Please select a user.',
            'user_id.exists'      => 'The selected user is invalid.',
            'plot_label.required' => 'Please enter a plot label.',
        ]);

        DB::transaction(function () use ($request) {
            // Update project with user_id
            $project = Project::findOrFail($request->project_id);
            $project->user_id = $request->user_id;
            $project->save();

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('projects'), $fileName);

                $imagePath = 'projects/' . $fileName; // relative path for DB
            }

            // Create project wing
            $wing = ProjectWing::create([
                'plot_label' => $request->plot_label,
                'project_id' => $request->project_id,
                'image' => $imagePath ?? null,
            ]);
        });

        return redirect()->route('admin.plot.index')->with('success', 'Plot(s) added successfully!');
        
    }

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

    public function update(Request $request, $id)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'user_id'    => 'required|exists:users,id',
            'plot_label' => 'required|string',
            'image' => 'nullable|image',
        ], [
            'project_id.required' => 'Please select a project.',
            'project_id.exists'   => 'The selected project is invalid.',
            'user_id.required'    => 'Please select a user.',
            'user_id.exists'      => 'The selected user is invalid.',
            'plot_label.required' => 'Please enter a plot label.',
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
                    // delete old file if exists
                    if ($wing && $wing->image && file_exists(public_path($wing->image))) {
                        unlink(public_path($wing->image));
                    }

                    // upload new image directly to /public/projects
                    $file = $request->file('image');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('projects'), $fileName);

                    $imagePath = 'projects/' . $fileName; // relative path for DB

                    // update or create wing
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
                }
                else {
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
            });

            return redirect()->route('admin.plot.edit', $id)->with('success', 'Plot updated successfully.');

        } catch (\Throwable $e) {
            \Log::error('Plot Update Error', ['message' => $e->getMessage()]);
            return redirect()
                ->back()
                ->with('error', 'Something went wrong: '.$e->getMessage())
                ->withInput();
        }
    }

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

    public function view_added_plots(Request $request)
    {
        $pid = en_de_crypt($request->get('project_id'), 'd');
        $wid = en_de_crypt($request->get('wing_id'), 'd');

        $wing_name = DB::table('project_wings')->where('id', $wid)->value('plot_label');
        $wing_image = DB::table('project_wings')->where('id', $wid)->value('image');

        $plots = [];

        // File path based on wing_id
        $file = public_path("wings/{$wid}/plots.json");

        if (File::exists($file)) {
            $plots = json_decode(File::get($file), true);
        }

        $project_record = DB::table('projects')->where('id', $pid)->first();

        return view('admin.plot.add_edit_plot',compact('wing_name','wid','pid','plots','wing_image','project_record'));
    }

    public function save_plots(Request $request)
    {
        $newPlots   = $request->input('plots');
        $wing       = $request->input('wing');       // e.g. "A"
        $project_id = $request->input('project_id'); // e.g. "123"

        if (!$wing || !$project_id) {
            return response()->json(['error' => 'Wing and Project ID are required'], 400);
        }

        // Ensure folder exists: public/wing/{wing}
        $dir = public_path("wings/{$wing}");
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $path = $dir . '/plots.json';

        // Load existing plots if file exists
        $existingPlots = [];
        if (file_exists($path)) {
            $existingPlots = json_decode(file_get_contents($path), true) ?? [];
        }

        // 🔑 Merge old + new plots
        foreach ($newPlots as $newPlot) {
            $found = false;

            foreach ($existingPlots as &$oldPlot) {
                if ($oldPlot['id'] === $newPlot['id']) {
                    $oldPlot = $newPlot; // update if exists
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $existingPlots[] = $newPlot; // add if not exists
            }
        }

        // Save back to file
        file_put_contents($path, json_encode($existingPlots, JSON_PRETTY_PRINT));


        $normalized = collect($existingPlots)->map(function ($plot) {
            // Force id to be numeric by stripping out non-digits
            $plot['id'] = (int) preg_replace('/\D/', '', $plot['id']);
            return $plot;
        });

        // Get current JSON IDs
        $jsonIds = collect($normalized)->pluck('id')->toArray();

        // Delete DB rows that are not in JSON
        \DB::table('plots')
            ->where('project_id', $project_id)
            ->where('project_wing_id', $wing)
            ->whereNotIn('plot_name', $jsonIds)
            ->delete();


        foreach ($normalized as $plot) {
            \DB::table('plots')->updateOrInsert(
                [
                    'plot_name'       => $plot['id'],         // unique key
                    'project_id'      => $project_id,
                    'project_wing_id' => $wing,
                ],
                [
                    'plot_size'       => $plot['size'] ?? null,
                    'plot_location'   => $plot['location'] ?? null,
                    'plot_dimensions' => $plot['dimensions'] ?? null,
                    'status'          => $plot['status'] ?? 'Available',
                    'updated_at'      => now(),
                ]
            );
        }

        return response()->json([
            'success'    => true,
            'wing'       => $wing,
            'project_id' => $project_id,
            'total'      => count($existingPlots)
        ]);
    }
}
