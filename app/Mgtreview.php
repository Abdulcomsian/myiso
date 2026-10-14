<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mgtreview extends Model
{
    protected $table='tbl_mgtreviews';

    /**
     * One row per answered question, plus 'A' for the decisions box.
     *
     * The review moved from sixteen free-text columns to the client's twelve
     * questions, and the answers live in their own table rather than in yet
     * more columns here. The old columns are still on the table, so a review
     * recorded before the change reads back exactly as it was.
     */
    public function answers()
    {
        return $this->hasMany(MgtreviewAnswer::class, 'mgtreview_id');
    }

    /** Part 3 C: who will do what, and by when */
    public function actions()
    {
        return $this->hasMany(MgtreviewAction::class, 'mgtreview_id')->orderBy('id');
    }

    /** Part 3 D: the minutes, slides, photos or video */
    public function files()
    {
        return $this->hasMany(MgtreviewFile::class, 'mgtreview_id')->orderBy('id');
    }

    /** the answers keyed by question number, ready for the form */
    public function answerMap()
    {
        $map = [];
        foreach ($this->answers as $a) {
            $map[$a->question_no] = $a;
        }
        return $map;
    }

    /** how many agreed actions have not been ticked done yet */
    public function openActions()
    {
        return $this->actions->where('done', false)->count();
    }

    /**
     * True for a review that was recorded on the old sixteen-box form: it has
     * none of the new answers, so the old boxes are what there is to show.
     */
    public function isLegacy()
    {
        return $this->answers->isEmpty();
    }

    /**
     * Everything the details popup shows, built here rather than in JavaScript
     * so the user page and the admin page cannot word it differently.
     */
    public function viewPayload()
    {
        $map = $this->answerMap();
        $out = [
            'id'            => $this->id,
            'reviewdate'    => $this->reviewdate,
            'chairedby'     => $this->chairedby,
            'meetingatt'    => $this->meetingatt,
            'nextreviewdue' => $this->nextreviewdue,
            'questions'     => [],
            'decisions'     => isset($map['A']) ? (string) $map['A']->answer : '',
            'objectives'    => [],
            'actions'       => [],
            'files'         => [],
            'legacy'        => [],
        ];

        foreach (MgtReviewQuestions::all() as $q) {
            $a = $map[$q['no']] ?? null;
            $out['questions'][] = [
                'no'     => $q['no'],
                'title'  => $q['title'],
                'answer' => $a ? (string) $a->answer : '',
                'file'   => $a && $a->evidence_file ? $a->evidence_file : '',
            ];
        }

        foreach (MgtReviewQuestions::objectives()['boxes'] as $box) {
            $out['objectives'][] = ['label' => $box['label'], 'value' => (string) ($this->{$box['field']} ?? '')];
        }

        foreach ($this->actions as $row) {
            $out['actions'][] = [
                'action' => $row->action,
                'who'    => $row->who,
                'when'   => $row->by_when,
                'done'   => (bool) $row->done,
            ];
        }

        foreach ($this->files as $f) {
            $out['files'][] = ['name' => $f->original_name ?: basename($f->file), 'url' => $f->file];
        }

        // a review recorded on the old sixteen-box form still has to read back
        if ($this->isLegacy()) {
            foreach (self::legacyFields() as $col => $label) {
                if (trim((string) $this->$col) !== '') {
                    $out['legacy'][] = ['label' => $label, 'value' => (string) $this->$col];
                }
            }
        }
        if ($this->attach_file) {
            $out['files'][] = ['name' => basename($this->attach_file), 'url' => $this->attach_file];
        }

        return $out;
    }

    /**
     * How this review reads in a dropdown or a details panel. It is here
     * rather than in the three blades that need it so the Objectives
     * Tracker, the admin copy and the dashboard cannot word it differently.
     */
    public function reviewLabel()
    {
        $name = $this->mgtreviewId ? 'Review ' . $this->mgtreviewId : 'Review';
        return $this->reviewdate
            ? $name . ' — ' . date('d M Y', strtotime($this->reviewdate))
            : $name;
    }

    /** the boxes the form used to ask for, kept so old reviews still read back */
    public static function legacyFields()
    {
        return [
            'prevmeeting'       => 'Previous Meeting',
            'recommendedchange' => 'Changes Recommended',
            'sammarisecustomr'  => 'Customer Satisfaction Summary',
            'prevobjectv'       => 'Comment on Previous Objectives',
            'conformity'        => 'Process Performance',
            'nonconformities'   => 'Non-conformities & Corrective Actions',
            'monitoringres'     => 'Monitoring Results',
            'auditres'          => 'Audit Results',
            'externalprovider'  => 'External Providers Performance',
            'adequacy'          => 'Adequacy of Resources',
            'effectiveness'     => 'Effectiveness of Actions',
        ];
    }
}
