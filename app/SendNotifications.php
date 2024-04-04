<?php

namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;

class SendNotifications extends Model
{
    protected $guarded = [];
    protected $table='send_notification'; 
    
    public function users(){
        return $this->belongsTo(User::class, 'send_by', 'id');
    }
}
