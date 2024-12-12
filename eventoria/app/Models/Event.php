<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    //
    use HasFactory;
    
    protected $fillable = [
        'event_name',
        'event_description',
        'event_location',
        'event_date',
        'event_image',
        'event_price',
        'event_provider',
    ];
}
