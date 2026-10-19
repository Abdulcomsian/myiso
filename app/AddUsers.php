<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddUsers extends Model
{
    protected $table='users';
    protected $casts = [
          'iso_certificates'  =>'array',
    ];

    /**
     * This client's certification paperwork: a certificate, audit report or
     * QA agreement per ISO standard, plus everything those replaced.
     *
     * The admin edit form is opened with the whole row encoded as JSON, so
     * the listing eager-loads this and the modal can show what each standard
     * already holds without a second request.
     */
    public function documents()
    {
        return $this->hasMany(UserDocument::class, 'user_id')->orderBy('id');
    }
}
