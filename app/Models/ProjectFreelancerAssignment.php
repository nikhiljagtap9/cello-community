<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectFreelancerAssignment extends Model
{
    protected $fillable = [
        'project_id',
        'freelancer_id',
        'plot_id',
        'role',
    ];
}
