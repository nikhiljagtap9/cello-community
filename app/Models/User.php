<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'password',
        'user_type',
        'parent_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // One-to-one relationship with user_details
    public function details()
    {
        return $this->hasOne(UserDetail::class);
    }

    // parent in the chain
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

     // children in the chain
    public function children()
    {
        return $this->hasMany(User::class, 'parent_id');
    }

    // freelancers under main user
    public function freelancers()
    {
        return $this->children()->where('user_type', 'freelancer');
    }

    // prospects under freelancer
    public function prospects()
    {
        return $this->children()->where('user_type', 'prospect');
    }

    // sub freelancers under prospect
    public function subFreelancers()
    {
        return $this->children()->where('user_type', 'sub_freelancer');
    }


    // sub prospects under sub freelancer
    public function subProspects()
    {
        return $this->children()->where('user_type', 'sub_prospect');
    }

    /* ----------------------
     | Business Rules
     ---------------------- */

    /**
     * Assign a new child user under current user.
     */
    public function addChild(array $attributes)
    {
        $type = $attributes['user_type'] ?? null;

        // Rule 1: Freelancer -> max 20 prospects
        if ($this->user_type === 'freelancer' && $type === 'prospect') {
            if ($this->prospects()->count() >= 20) {
                throw new \Exception("Freelancer already has max 20 prospects");
            }
        }

        // Rule 2: Prospect -> max 2 sub-freelancers
        if ($this->user_type === 'prospect' && $type === 'sub_freelancer') {
            if ($this->subFreelancers()->count() >= 2) {
                throw new \Exception("Prospect already has max 2 sub-freelancers");
            }
        }

        // Rule 3: Sub-Freelancer -> max 20 sub-prospects
        if ($this->user_type === 'sub_freelancer' && $type === 'sub_prospect') {
            if ($this->subProspects()->count() >= 20) {
                throw new \Exception("Sub-Freelancer already has max 20 sub-prospects");
            }
        }

        // Add parent_id automatically
        $attributes['parent_id'] = $this->id;

        return self::create($attributes);
    }
}
