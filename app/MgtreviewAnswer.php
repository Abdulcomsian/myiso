<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MgtreviewAnswer extends Model
{
    protected $table = 'tbl_mgtreview_answers';

    /** the pair a row is looked up by, so firstOrNew can fill them */
    protected $fillable = ['mgtreview_id', 'question_no', 'answer', 'evidence_file'];

    public function review()
    {
        return $this->belongsTo(Mgtreview::class, 'mgtreview_id');
    }
}
