<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plot extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'plot_name',
        'plot_size',
        'plot_location',
        'plot_dimensions',
        'project_id',
        'project_wing_id',
        'status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function wing()
    {
        return $this->belongsTo(ProjectWing::class, 'project_wing_id');
    }

    public function assignments()
    {
        return $this->hasMany(ProjectFreelancerAssignment::class, 'plot_id');
    }

}

