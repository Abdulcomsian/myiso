<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workinstructions extends Model
{
    protected $table='tbl_workinstruction';

    /**
     * How often the instruction is to be reviewed or actioned.
     *
     * The key is what goes in the database and the label is what is shown, so
     * the English and Arabic sites can word the same record their own way -
     * the pattern Incident severity already uses.
     */
    public static function frequencyOptions()
    {
        return [
            'monthly'     => 'Monthly',
            'quarterly'   => 'Quarterly',
            '6_months'    => 'Every 6 months',
            'annually'    => 'Annually',
            'as_required' => 'As required',
        ];
    }

    /** the wording for this record's frequency, or a dash when none is set */
    public function frequencyLabel()
    {
        return self::frequencyOptions()[$this->reviewFrequency] ?? '—';
    }
}
