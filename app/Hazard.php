<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hazard extends Model
{
    protected $table = 'tbl_hazards';

    protected $fillable = ['hazard', 'risk', 'controls', 'responsible_person', 'monitoring_method'];
}
