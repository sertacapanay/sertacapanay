<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GuestUser extends Model
{
    protected $fillable = [
        'google_id',
        'name',
        'email',
        'avatar_url',
    ];

    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class);
    }
}
