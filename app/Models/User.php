<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable;
    use InteractsWithMedia;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
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
    ];


    public function rescued(): BelongsToMany
    {
        return $this->belongsToMany(Animal::class, 'animal_rescuer', 'user_id', 'animal_id');
    }

    public function veterinarian_animal(): BelongsToMany
    {
        return $this->belongsToMany(Animal::class, 'animal_veterinarian', 'user_id', 'animal_id');
    }

    public function adopted(): BelongsToMany
    {
        return $this->belongsToMany(Animal::class, 'animal_adopter', 'user_id', 'animal_id');
    }


    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    
}
