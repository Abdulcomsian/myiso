<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNotesHistory extends Model
{
    protected $table = "user_notes_history";
    protected $fillable = ['company_id', 'note', 'dated'];
}
