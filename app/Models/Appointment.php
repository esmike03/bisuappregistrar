<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = ['fName', 'lName', 'mName', 'suffix', 'email', 'ygrad', 'ismis', 'campus', 'picture', 'course', 'reason', 'copy','status', 'appstatus', 'request', 'appdate', 'tracking_code'];

}
