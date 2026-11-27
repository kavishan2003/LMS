<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'subject_code',
        'teacher_id',
        'title',
        'instructions',
        'attachment_path',
        'deadline',
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }
}
