<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OLSubjects extends Model
{
    protected $table = 'OLsubjects';

    protected $fillable = [
        'id',
        'subject_code',
        'name',
        'medium',
        'category',
    ];

    public function students()
    {
        return $this->belongsToMany(User::class, 'student_ol_subject', 'olsubject_id', 'user_id')->withPivot(['grade', 'medium'])->withTimestamps();
    }
}
