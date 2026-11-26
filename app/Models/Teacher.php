<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'user_id',
        'teacher_code',
        'qualification',
        'specialization',
        'section',
        'is_active',
    ];

    protected $casts = [
        'specialization' => 'array',
    ];

    // when teacher loads the user details loads always
    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //
    public function getNameAttribute()
    {
        return $this->user->name ?? null;
    }

    public function getEmailAttribute()
    {
        return $this->user->email ?? null;
    }

    public function getPhoneAttribute()
    {
        return $this->user->phone ?? null;
    }

    public function getGenderAttribute()
    {
        return $this->user->gender ?? null;
    }

    public function getDobAttribute()
    {
        return $this->user->dob ?? null;
    }

    public function getTeacherSubjects()
    {
        return $this->teacherSubject ? $this->teacherSubject->getSubjects() : collect();
    }

    public function teacherSubject()
    {
        return $this->hasOne(TeacherSubject::class, 'teacher_id');
    }
}
