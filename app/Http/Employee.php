<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];
    protected $table="tbl_employees";
    
     public function skills()
    {
        return $this->hasMany(EmpSkills::class,'skill_id');
    }
}
