<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QmsauditAnswer extends Model
{
    protected $table = 'tbl_qmsaudit_answers';

    /** the pair a row is looked up by, so firstOrNew can fill them */
    protected $fillable = ['qmsaudit_id', 'question_no', 'answer', 'note', 'evidence_file'];

    public function audit()
    {
        return $this->belongsTo(Qmsaudit::class, 'qmsaudit_id');
    }
}
