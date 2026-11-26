<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherSubject extends Model
{
    protected $table = 'teacher_subjects';

    protected $fillable = [
        'teacher_id',
        'section',
        'subject_1_id',
        'subject_2_id',
        'subject_3_id',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    // getting the teachers subjects
    public function getSubjects()
    {
        $ids = array_filter([
            $this->subject_1_id,
            $this->subject_2_id,
            $this->subject_3_id,
        ]);

        if ($this->section === 'AL') {
            return ALSubjects::whereIn('id', $ids)->get();
        }

        return OLSubjects::whereIn('id', $ids)->get();
    }

    // public function teacherSubject()
    // {
    //     return $this->hasOneThrough(
    //         TeacherSubject::class,
    //         Teacher::class,
    //         'user_id', // teachers table's foreign key
    //         'teacher_id', // teacher_subjects table's foreign key
    //         'id',
    //         'id'
    //     );
    // }
}
