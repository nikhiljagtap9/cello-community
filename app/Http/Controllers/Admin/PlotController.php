<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plot;
use Illuminate\Http\Request;

class PlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plots = Plot::latest()->get();
        return view('admin.plot.index', compact('plots'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.plot.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'plot_name' => 'required',
            'plot_size' => 'required',
            'plot_location' => 'required',
            'plot_dimensions' => 'required',
        ]);
        Plot::create($request->all());
        return redirect()->route('admin.plot.index')->with('success', 'Plot added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $plot =  Plot::findOrFail($id);
        return view('admin.plot.edit',compact('plot'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'plot_name' => 'required',
            'plot_size' => 'required',
            'plot_location' => 'required',
            'project_name' => 'required',
        ]);
        $plot = Plot::findorFail($id);
        $plot->update($request->all());
        return redirect()->route('admin.plot.index')->with('success', 'Plot updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $plot = Plot::findOrFail($id);
        $plot->delete();
        return redirect()->route('admin.plot.index')->with('success', 'Plot deleted successfully.');
    }
}
