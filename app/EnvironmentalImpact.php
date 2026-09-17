<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnvironmentalImpact extends Model
{
    protected $table = 'tbl_environmental_impacts';

    protected $fillable = ['aspect', 'impact', 'controls', 'responsible_person', 'monitoring_method'];
}
