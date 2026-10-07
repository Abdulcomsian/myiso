<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    protected $table = 'tbl_objectives';

    /**
     * The five states an objective can be in.
     *
     * The key is stored and the label is shown, so the English and Arabic sites
     * can word the same record their own way. 'chip' is the colour the list and
     * the history use; the plain one is the grey "nothing has happened yet".
     */
    public static function statuses()
    {
        return [
            'not_started'  => ['label' => 'Not started',  'chip' => 'neutral',        'means' => 'Agreed, but no work has begun yet.'],
            'on_track'     => ['label' => 'On track',     'chip' => 'success', 'means' => 'Progress is where it should be to hit the deadline.'],
            'at_risk'      => ['label' => 'At risk',      'chip' => 'warning', 'means' => 'Behind plan. Say what you will do to catch up.'],
            'achieved'     => ['label' => 'Achieved',     'chip' => 'info',    'means' => 'The target was met. Add the final result as evidence.'],
            'not_achieved' => ['label' => 'Not achieved', 'chip' => 'danger',  'means' => 'Deadline passed without meeting the target. Discuss at Management Review.'],
        ];
    }

    /** how long an objective may go without a progress note before it is chased */
    const STALE_DAYS = 90;

    public static function statusLabel($key)
    {
        return self::statuses()[$key]['label'] ?? $key;
    }

    public static function statusChip($key)
    {
        return self::statuses()[$key]['chip'] ?? '';
    }

    /** every progress note, newest first */
    public function updates()
    {
        return $this->hasMany(ObjectiveUpdate::class, 'objective_id')
                    ->orderByDesc('update_date')->orderByDesc('id');
    }

    /** the most recent progress note, or null when none has been added yet */
    public function latestUpdate()
    {
        return $this->updates()->first();
    }

    /** true when nothing has been recorded for STALE_DAYS, so it needs chasing */
    public function updateIsDue()
    {
        if (in_array($this->status, ['achieved', 'not_achieved'], true)) {
            return false;                       // finished, nothing left to chase
        }
        $last = $this->latestUpdate();
        $since = $last ? ($last->update_date ?: $last->created_at) : $this->created_at;
        if (!$since) {
            return false;
        }
        return strtotime($since) < strtotime('-' . self::STALE_DAYS . ' days');
    }
}
