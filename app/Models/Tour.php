<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Tour extends Model
{
    protected $fillable = [
        'title_tr', 'title_en', 'slug',
        'region_tr', 'region_en', 'country_tr', 'country_en',
        'duration_days', 'price', 'currency', 'start_date',
        'cover_image', 'booking_url',
        'short_description_tr', 'short_description_en',
        'description_tr', 'description_en',
        'is_featured', 'is_active',
    ];

    protected $casts = [
        'start_date'  => 'date',
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
        'price'       => 'decimal:2',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->whereDate('start_date', '>=', now()->toDateString());
    }
}
