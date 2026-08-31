<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceHistory extends Model
{
    use HasFactory;

    protected $table = 'price_histories';

    protected $fillable = [
        'make',
        'model',
        'year',
        'avg_price',
        'sample_count',
        'recorded_at',
    ];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'avg_price' => 'decimal:2',
            'sample_count' => 'integer',
            'recorded_at' => 'datetime',
        ];
    }
}
