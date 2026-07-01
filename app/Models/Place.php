<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Place extends Model
{
    protected $fillable = [
        'name_tr', 'name_en', 'slug', 'type',
        'country_tr', 'country_en', 'city_tr', 'city_en', 'region_tr', 'region_en',
        'cover_image',
        'short_description_tr', 'short_description_en',
        'history_tr', 'history_en',
        'stories_tr', 'stories_en',
        'what_to_see_tr', 'what_to_see_en',
        'latitude', 'longitude',
        'is_featured', 'is_active',
    ];

    protected $casts = [
        'latitude'    => 'decimal:7',
        'longitude'   => 'decimal:7',
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
