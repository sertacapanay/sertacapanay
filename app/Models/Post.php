<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Post extends Model
{
    protected $fillable = [
        'title', 'slug', 'excerpt', 'body', 'image', 'category_tr', 'category_en',
        'is_published', 'published_at', 'meta_title', 'meta_description',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
