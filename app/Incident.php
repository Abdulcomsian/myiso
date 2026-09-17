<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $table = 'tbl_incidents';

    protected $fillable = [
        'incident_date', 'description', 'injured_person', 'severity', 'location',
        'first_aid', 'witnesses', 'investigation', 'corrective_actions', 'status',
    ];

    protected $casts = [
        'incident_date' => 'date:Y-m-d',
    ];
}
