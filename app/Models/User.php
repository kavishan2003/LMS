<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable(['name',
    'email',
    'phone',
    'gender',
    'role',
    'dob',
    'password', ])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function olsubjects()
    {
        return $this->hasOne(StudentOlSubject::class, 'user_id');
    }

    public function alsubjects()
    {
        return $this->hasOne(StudentAlSubject::class, 'user_id');
    }

    public function getGradeLabelAttribute()
    {
        if ($this->alsubjects) {
            return "Grade {$this->alsubjects->grade} A/L";
        }

        if ($this->olsubjects) {
            $grade = $this->olsubjects->grade;
            $tag = in_array($grade, [10, 11]) ? ' O/L' : '';

            return "Grade {$grade}{$tag}";
        }

        return null; // Teacher කෙනෙක් හෝ තාම grade එක select කරලා නැති student කෙනෙක් නම්
    }
}
