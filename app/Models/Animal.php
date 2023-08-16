<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Animal extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'is_healthy',
        'breed',
        'age',
        'gender',
        'adoption_status'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('animals');
    }



    public function rescuers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'animal_rescuer', 'animal_id', 'user_id');
    }

    public function animal_veterinarians(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'animal_veterinarian', 'animal_id', 'user_id');
    }


    public function adopters(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'animal_adopter', 'animal_id', 'user_id');
    }

    public function diseases(): BelongsToMany
    {
        return $this->belongsToMany(Disease::class, 'animal_dieseas', 'animal_id', 'disease_id');
    }


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


 
}
