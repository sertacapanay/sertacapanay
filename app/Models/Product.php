<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    protected $fillable = [
        'title_tr', 'title_en', 'slug', 'description_tr', 'description_en',
        'image', 'price', 'category_tr', 'category_en', 'is_active', 'affiliate_url',
        'meta_title_tr', 'meta_title_en', 'meta_description_tr', 'meta_description_en',
    ];
}
