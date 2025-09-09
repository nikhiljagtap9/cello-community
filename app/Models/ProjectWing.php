<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectWing extends Model
{
    use SoftDeletes;

    protected $fillable = ['plot_label', 'project_id','image'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function plots()
    {
        return $this->hasMany(Plot::class);
    }
}
