<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CertificateOption extends Model
{
    protected $connection = 'second_db';
    protected $table = 'wp_options';
}
