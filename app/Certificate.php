<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    //use HasFactory;
    
    protected $connection = 'second_db';
    protected $table = 'wp_users';
}
