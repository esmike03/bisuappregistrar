<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectedAppointment extends Model
{

    use HasFactory;
    protected $fillable = ['fname', 'lname', 'mname', 'suffix', 'email', 'ygrad', 'ismis', 'campus', 'status', 'appstatus', 'reason', 'request', 'appdate', 'tracking_code'];
}
