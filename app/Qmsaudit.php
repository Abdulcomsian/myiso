<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qmsaudit extends Model
{
    protected $table="tbl_qmsaudit";

    /**
     * One row per question answered. The audit moved from 29 ISO clauses to
     * 17 questions, and the answers live in their own table rather than in yet
     * more columns here.
     */
    public function answers()
    {
        return $this->hasMany(QmsauditAnswer::class, 'qmsaudit_id')->orderBy('question_no');
    }
}
