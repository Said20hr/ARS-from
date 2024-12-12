<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'job_title',
        'company_name',
        'industry',
        'motivation',
        'contribution',
        'previous_event',
        'previous_event_details',
        'heard_about',
    ];
}
