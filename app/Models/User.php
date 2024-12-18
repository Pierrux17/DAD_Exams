<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'nationality_id',
        'company_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public static function roles()
    {
        return [
            'admin',
            'client',
            'supervisor',
        ];
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isClient()
    {
        return $this->role === 'client';
    }

    public function isSupervisor()
    {
        return $this->role === 'supervisor';
    }

    
    /**
     * Function Access Panel Admin and Supervisor
     */
    public function canAccessPanel(Panel $panel): bool
    {
        if($panel->getId() === 'admin' && !$this->isAdmin()) {
            return false;
        }

        if($panel->getId() === 'supervisor' && !$this->isSupervisor()) {
            return false;
        }

        return true;
    }
}
