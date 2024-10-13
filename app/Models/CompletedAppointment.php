<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompletedAppointment extends Model
{
    use HasFactory;
    protected $fillable = ['fname', 'lname', 'mname', 'suffix', 'email', 'ygrad', 'ismis', 'campus','status', 'appstatus', 'request', 'appdate', 'tracking_code'];
}
