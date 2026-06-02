<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddUsers extends Model
{
    protected $table='users';
    protected $casts = [
          'iso_certificates'  =>'array',
    ];
}
