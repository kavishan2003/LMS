<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentOlSubject extends Model
{
    protected $table = 'student_ol_subject';

    protected $fillable = [
        'user_id',
        'grade',
        'medium',
        'main_subjects',
        'religion_id',
        'basket_1_id',
        'basket_2_id',
        'basket_3_id',
    ];

    protected $casts = [
        'main_subjects' => 'array',
    ];

    // get all subjects including main subjects, religion, and basket subjects
    public function getAllSubjects()
    {
        $ids = array_filter(array_merge(
            $this->main_subjects ?? [],
            [
                $this->religion_id,
                $this->basket_1_id,
                $this->basket_2_id,
                $this->basket_3_id,
            ]
        ));

        return OLSubjects::whereIn('id', $ids)->get();
    }
}