<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentMark extends Model
{
    protected $fillable = [
        'subject_code',
        'user_id',
        'teacher_id',
        'exam_title',
        'marks',
        'remarks',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
