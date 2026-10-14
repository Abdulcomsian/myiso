<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MgtreviewFile extends Model
{
    protected $table = 'tbl_mgtreview_files';

    protected $fillable = ['mgtreview_id', 'file', 'original_name'];

    public function review()
    {
        return $this->belongsTo(Mgtreview::class, 'mgtreview_id');
    }
}
