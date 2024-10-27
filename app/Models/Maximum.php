<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maximum extends Model
{
    use HasFactory;
    protected $fillable = ['campus', 'num'];

}
