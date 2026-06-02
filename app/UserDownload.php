<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDownload extends Model
{
    protected $table = "users_downloads";

    public function downloads(){
        return $this->belongsTo(Download::class, 'download_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
