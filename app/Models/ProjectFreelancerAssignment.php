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
        'status'
    ];

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    /**
    * parent_id in users = inviter’s id

    * freelancer_id in project_freelancer_assignments table links to the inviter’s user ID.
     */
   public function invitedUsers()
    {
        return $this->hasMany(User::class, 'parent_id', 'freelancer_id');
    }

}
