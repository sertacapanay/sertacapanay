<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cruise extends Model
{
    protected $fillable = [
        'title_tr', 'title_en', 'slug',
        'ship_name', 'cruise_line',
        'from_port_tr', 'from_port_en', 'to_port_tr', 'to_port_en',
        'country_tr', 'country_en',
        'nights', 'departure_date', 'cover_image',
        'short_description_tr', 'short_description_en',
        'description_tr', 'description_en',
        'is_active',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'is_active'       => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
