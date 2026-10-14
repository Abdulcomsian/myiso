<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MgtreviewAction extends Model
{
    protected $table = 'tbl_mgtreview_actions';

    protected $fillable = ['mgtreview_id', 'action', 'who', 'by_when', 'done'];

    protected $casts = ['done' => 'boolean'];

    public function review()
    {
        return $this->belongsTo(Mgtreview::class, 'mgtreview_id');
    }
}
