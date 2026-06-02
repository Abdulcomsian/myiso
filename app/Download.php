<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    //

    public function downloadUserType(){
        return $this->belongsTo(UserType::class, 'user_type');
    }
}
