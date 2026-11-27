<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    protected $fillable = [
        'assignment_id',
        'user_id',
        'file_path',
        'original_filename',
        'student_note',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
