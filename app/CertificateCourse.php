<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CertificateCourse extends Model
{
    protected $connection = 'second_db';
    protected $table = 'wp_posts';
}
