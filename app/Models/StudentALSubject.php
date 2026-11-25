<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAlSubject extends Model
{
    protected $table = 'student_al_subject';

    protected $fillable = [
        'user_id',
        'grade',
        'medium',
        'stream',
        'compulsory_subjects',
        'subject_1_id',
        'subject_2_id',
        'subject_3_id',
    ];

    protected $casts = [
        'compulsory_subjects' => 'array',
    ];

    // to get (Main 3 + Compulsory 2)
    public function getAllSubjects()
    {
        $ids = array_filter(array_merge(
            [
                $this->subject_1_id,
                $this->subject_2_id,
                $this->subject_3_id,
            ],
            $this->compulsory_subjects ?? []
        ));

        return ALSubjects::whereIn('id', $ids)->get();
    }
}