<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimonial extends Model
{
    protected $fillable = [
        'guest_user_id',
        'tour_id',
        'body',
        'is_approved',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    public function guestUser(): BelongsTo
    {
        return $this->belongsTo(GuestUser::class);
    }

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }
}
