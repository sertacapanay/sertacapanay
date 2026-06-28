<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Flight extends Model
{
    protected $fillable = [
        'from_city', 'to_city', 'from_iata', 'to_iata',
        'flight_date', 'airline', 'flight_number', 'distance_km', 'notes',
    ];
}
