<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWingAssignment extends Model
{
    protected $fillable = [
        'user_id',
        'project_wing_id',
        'assigned_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wing()
    {
        return $this->belongsTo(ProjectWing::class, 'project_wing_id');
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}
