<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'label',
        'description',
        'price',
        'duration_minutes',
        'available',
    ];

    public function resources(): BelongsToMany
    {
        return $this->belongsToMany(Resource::class);
    }
}
