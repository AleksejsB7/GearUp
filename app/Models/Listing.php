<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'make',
        'model',
        'year',
        'price',
        'fuel_type',
        'mileage',
        'description',
        'vin',
        'car_number',
        'phone',
        'vehicle_type',
        'engine_volume',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'year' => 'integer',
            'mileage' => 'integer',
            'engine_volume' => 'decimal:1',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ListingImage::class);
    }

    public function savedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'saved_listings');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
