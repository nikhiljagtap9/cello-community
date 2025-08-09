<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'image', 'user_id'
    ];

    public function plots()
    {
        return $this->hasMany(Plot::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
