<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $connection = 'second_db';
   
    protected $guarded = [];
    protected $table="tbl_employees";
    // protected $table="wp_users";
    //protected $table="wp_usermeta";
    
     public function skills()
    {
        return $this->hasMany(EmpSkills::class,'skill_id');
    }
}
