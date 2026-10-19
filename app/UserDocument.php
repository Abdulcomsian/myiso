<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * One certification document belonging to a client: a certificate, an audit
 * report or a QA agreement, for one ISO standard.
 *
 * A client who gains a second standard months after the first needs a second
 * audit report and a second QA agreement, and when anything is renewed the
 * paperwork it replaces has to survive. Both of those were impossible while
 * the users table held one audit_report and one qa_certification: the new
 * upload overwrote the row and deleted the old PDF off disk.
 *
 * The users table is deliberately left alone. iso*_certificate still holds the
 * current certificate, because the notification and reporting filters query
 * those columns directly; audit_report and qa_certification still hold the
 * general, standard-less document a client may already have.
 */
class UserDocument extends Model
{
    protected $table = 'tbl_user_documents';

    protected $fillable = [
        'user_id', 'standard', 'doc_type', 'file_path',
        'comment', 'expiry_date', 'is_current', 'archived_at',
    ];

    const TYPE_CERTIFICATE = 'certificate';
    const TYPE_AUDIT       = 'audit_report';
    const TYPE_QA          = 'qa_agreement';

    /** the standards a document can belong to, in the order the forms show them */
    public static function standards()
    {
        return [
            'iso9001'  => 'ISO 9001',
            'iso14001' => 'ISO 14001',
            'iso45001' => 'ISO 45001',
        ];
    }

    public static function docTypes()
    {
        return [
            self::TYPE_CERTIFICATE => 'Certificate',
            self::TYPE_AUDIT       => 'Audit Report',
            self::TYPE_QA          => 'QA Agreement',
        ];
    }

    public static function standardLabel($key)
    {
        $all = self::standards();
        return $all[$key] ?? $key;
    }

    public static function typeLabel($key)
    {
        $all = self::docTypes();
        return $all[$key] ?? $key;
    }

    /**
     * Everything a client has now, as $out[standard][doc_type] = document.
     * One query, because the admin form asks for all nine cells at once.
     */
    public static function currentFor($userId)
    {
        $out = [];
        foreach (self::where('user_id', $userId)->where('is_current', 1)
                     ->orderBy('id')->get() as $doc) {
            $out[$doc->standard][$doc->doc_type] = $doc;     // a later row wins
        }
        return $out;
    }

    /** what the "Previous Certificates & Audit Reports" section lists, newest first */
    public static function archivedFor($userId)
    {
        return self::where('user_id', $userId)->where('is_current', 0)
            ->orderByDesc('archived_at')->orderByDesc('id')->get();
    }

    /**
     * Store a newly uploaded document, putting whatever it replaces into the
     * history rather than destroying it.
     *
     * Returns the new row. $expiry and $comment are only meaningful for a
     * certificate and an audit report respectively; a QA agreement passes
     * neither.
     */
    public static function put($userId, $standard, $docType, $filePath, $comment = null, $expiry = null)
    {
        if (!$filePath) {
            return null;
        }

        self::supersede($userId, $standard, $docType);

        return self::create([
            'user_id'     => $userId,
            'standard'    => $standard,
            'doc_type'    => $docType,
            'file_path'   => $filePath,
            'comment'     => $comment,
            'expiry_date' => $expiry ?: null,
            'is_current'  => 1,
            'archived_at' => null,
        ]);
    }

    /** move whatever is current for this slot into the history */
    public static function supersede($userId, $standard, $docType)
    {
        return self::where('user_id', $userId)
            ->where('standard', $standard)
            ->where('doc_type', $docType)
            ->where('is_current', 1)
            ->update(['is_current' => 0, 'archived_at' => DB::raw('NOW()')]);
    }

    /**
     * Record a document that has already been replaced elsewhere - used when a
     * certificate held in the users table is renewed, so the old certificate
     * still ends up in the history even though its current copy does not live
     * in this table.
     */
    public static function archive($userId, $standard, $docType, $filePath, $comment = null, $expiry = null)
    {
        if (!$filePath) {
            return null;
        }

        // don't file the same superseded document twice if an admin saves the
        // form again without changing anything
        $already = self::where('user_id', $userId)
            ->where('standard', $standard)
            ->where('doc_type', $docType)
            ->where('file_path', $filePath)
            ->where('is_current', 0)
            ->exists();
        if ($already) {
            return null;
        }

        return self::create([
            'user_id'     => $userId,
            'standard'    => $standard,
            'doc_type'    => $docType,
            'file_path'   => $filePath,
            'comment'     => $comment,
            'expiry_date' => $expiry ?: null,
            'is_current'  => 0,
            'archived_at' => date('Y-m-d H:i:s'),
        ]);
    }

    /** the date to show against an archived document */
    public function archivedOn()
    {
        $when = $this->archived_at ?: $this->created_at;
        return $when ? date('d M Y', strtotime($when)) : '';
    }
}
