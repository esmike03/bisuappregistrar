<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $table = 'holidays';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'holiday_date',
        'name',
    ];

    // Specify the attributes that should be cast to native types
    protected $casts = [
        'holiday_date' => 'date',
    ];
}
