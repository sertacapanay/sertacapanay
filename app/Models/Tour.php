<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Tour extends Model
{
    protected $fillable = [
        'title_tr', 'title_en', 'slug', 'excerpt_tr', 'excerpt_en', 'body_tr', 'body_en',
        'image', 'country_tr', 'country_en', 'price', 'duration_days', 'is_active',
        'meta_title_tr', 'meta_title_en', 'meta_description_tr', 'meta_description_en',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
