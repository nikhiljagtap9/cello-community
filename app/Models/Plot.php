<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plot extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'plot_name', 'plot_size', 'plot_location', 'project_name',
    ];
}
