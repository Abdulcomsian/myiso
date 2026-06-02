<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpSkills extends Model
{
     protected $guarded = [];
     protected $table="tbl_employees_skills";
    
     public function employee()
    {
        return $this->belongsTo(Employee::class,'empid');
    }
}
