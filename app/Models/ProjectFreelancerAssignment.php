<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectFreelancerAssignment extends Model
{
    protected $fillable = [
        'project_id',
        'user_id',
        'plot_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * parent_id in users = inviter’s id
     * user_id in project_freelancer_assignments links to the inviter’s user ID.
     */
    public function invitedUsers()
    {
        return $this->hasMany(User::class, 'parent_id', 'user_id');
    }

    public function plot()
    {
        return $this->belongsTo(Plot::class, 'plot_id');
    }
}
