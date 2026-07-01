<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Flight extends Model
{
    protected $fillable = [
        'from_city', 'to_city',
        'flight_date', 'airline', 'flight_number', 'distance_km',
        'notes_tr', 'notes_en',
    ];

    protected $casts = [
        'flight_date' => 'date',
    ];
}
