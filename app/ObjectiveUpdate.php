<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObjectiveUpdate extends Model
{
    protected $table = 'tbl_objective_updates';

    public function objective()
    {
        return $this->belongsTo(Objective::class, 'objective_id');
    }
}
