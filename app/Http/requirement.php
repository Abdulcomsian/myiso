<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class requirement extends Model
{
    protected $table = 'tbl_requiremnt';
    // protected $fillable = ['requirment_id'];

    public function user()
    {
        $this->belongsTo('app\User','user_id','id');
    }
}
