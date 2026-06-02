<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table="tbl_employees";


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
